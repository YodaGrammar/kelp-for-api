<?php

namespace App\Mapper;

use App\DTO\StorageDTO;
use App\Entity\Repository\StorageRepository;
use App\Entity\Storage;
use App\Entity\User;
use App\Factory\StorageFactory;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class StorageMapper
 *
 * @package Kelp\AppBundle\Mapper
 */
class StorageMapper
{

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var StorageFactory
     */
    protected $storageFactory;

    /**
     * StorageMapper constructor.
     * @param ObjectManager  $objectManager
     * @param StorageFactory $storageFactory
     */
    public function __construct(ObjectManager $objectManager, StorageFactory $storageFactory)
    {
        $this->objectManager  = $objectManager;
        $this->storageFactory = $storageFactory;
    }

    /**
     * @return ObjectRepository|StorageRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->objectManager->getRepository(Storage::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function findAllByUser(User $user)
    {
        return $this->getRepository()->findBy(['user' => $user]);
    }

    /**
     * @param StorageDTO $dto
     * @throws \App\Exception\NotFoundException
     */
    public function add(StorageDTO $dto)
    {
        $storage = $this->storageFactory->newInstance($dto);
        $this->objectManager->persist($storage);
        $this->objectManager->flush();
    }

    /**
     * @param StorageDTO $dto
     */
    public function edit(StorageDTO $dto)
    {
        /** @var Storage $storage */
        $storage = $this->getRepository()->find($dto->id);
        if (!$storage) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $dto->id));
        }
        $storage->setLabel($dto->label);
        $this->objectManager->flush();
    }

//
//    /**
//     * @param string $idTypeStorage
//     * @return TypeStorage
//     */
//    public function find(string $idTypeStorage)
//    {
//        /** @var TypeStorage $typeStorage */
//        $typeStorage = $this->getRepository()->find($idTypeStorage);
//        if (!$typeStorage) {
//            throw new \LogicException(sprintf('impossible to find information for id %s', $idTypeStorage));
//        }
//
//        return $typeStorage;
//    }
//
//    /**
//     * @param string $idTypeStorage
//     * @param TypeStorageDTO $dto
//     */
//    public function edit(string $idTypeStorage, TypeStorageDTO $dto)
//    {
//        /** @var TypeStorage $typeStorage */
//        $typeStorage = $this->getRepository()->find($idTypeStorage);
//        if (!$typeStorage) {
//            throw new \LogicException(sprintf('impossible to find information for id %s', $idTypeStorage));
//        }
//        $typeStorage->setLabel($dto->label);
//        $typeStorage->setComment($dto->comment);
//        $typeStorage->setClass($dto->class);
//        $this->objectManager()->flush($typeStorage);
//    }
//
//    /**
//     * @param $id
//     */
//    public function delete($id)
//    {
//        /** @var TypeStorage $typeStorage */
//        $typeStorage = $this->getRepository()->find($id);
//        if (!$typeStorage) {
//            throw new \LogicException(sprintf('impossible to find information for id %s', $id));
//        }
//        $typeStorage->setActive(false);
//        $this->getManager()->flush($typeStorage);
//    }
}
