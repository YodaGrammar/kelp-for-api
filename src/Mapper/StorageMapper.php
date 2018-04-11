<?php

namespace App\Mapper;

use App\DTO\StorageDTO;
use App\Entity\Repository\StorageRepository;
use App\Entity\Storage;
use App\Entity\User;
use App\EntityFactory\StorageEntityFactory;
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
     * @var StorageFactoryEntity
     */
    protected $storageFactory;

    /**
     * StorageMapper constructor.
     * @param ObjectManager        $objectManager
     * @param StorageEntityFactory $storageFactory
     */
    public function __construct(ObjectManager $objectManager, StorageEntityFactory $storageFactory)
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
        return $this->getRepository()->findBy(
            [
                'user'   => $user,
                'active' => true,
            ]
        );
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

    /**
     * @param $id
     */
    public function delete($id)
    {
        /** @var Storage $storage */
        $storage = $this->getRepository()->find($id);
        if (!$storage) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $id));
        }
        $storage->setActive(false);
        $this->objectManager->flush();
    }
}
