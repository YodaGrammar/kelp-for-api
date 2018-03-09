<?php

namespace App\Mapper;

use App\Entity\Repository\StorageRepository;
use App\Entity\User;
use App\Factory\StorageFactory;
use App\Factory\TypeStorageFactory;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StorageMapper
 *
 * @package Kelp\AppBundle\Mapper
 */
class UserMapper
{

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var TypeStorageFactory
     */
    protected $storageFactory;

    /**
     * StorageMapper constructor.
     * @param ObjectManager $objectManager
     * @param StorageFactory $storageFactory
     */
    public function __construct(ObjectManager $objectManager, StorageFactory $storageFactory)
    {
        $this->objectManager  = $objectManager;
        $this->storageFactory = $storageFactory;
    }

    /**
     * @return StorageRepository
     */
    protected function getRepository(): StorageRepository
    {
        return $this->objectManager->getRepository(User::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param $id
     * @return null|object
     */
    public function findOneByid($id)
    {
        return $this->getRepository()->find($id);
    }

//    /**
//     * @param FilterTypeStorageDTO|null $typeStorageDTO
//     * @param $page
//     * @return mixed
//     */
//    public function findAllByFilters(FilterTypeStorageDTO $typeStorageDTO = null, $page = null)
//    {
//        return $this->getRepository()->findAllByFilters($typeStorageDTO->text, $page);
//    }
//
//    /**
//     * @param TypeStorageDTO $dto
//     */
//    public function add(TypeStorageDTO $dto)
//    {
//        $typeStorage = $this->typeStorageFactory->newInstance($dto);
//        $this->objectManager->persist($typeStorage);
//        $this->objectManager->flush($typeStorage);
//    }
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
