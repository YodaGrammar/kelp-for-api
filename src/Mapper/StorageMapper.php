<?php

namespace App\Mapper;

use App\DTO\StorageDTO;
use App\Repository\StorageRepository;
use App\Entity\Storage;
use App\Entity\User;
use App\Factory\StorageFactory;

/**
 * Class StorageMapper
 *
 * @package Kelp\AppBundle\Mapper
 */
class StorageMapper
{
    /**
     * @var StorageFactory
     */
    protected $storageFactory;

    /**
     * @var StorageRepository
     */
    private $repository;

    /**
     * StorageMapper constructor.
     * @param StorageRepository $repository
     * @param StorageFactory $storageFactory
     */
    public function __construct(StorageRepository $repository, StorageFactory $storageFactory)
    {
        $this->storageFactory = $storageFactory;
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function findAllByUser(User $user)
    {
        return $this->repository->findBy(
            [
                'user'   => $user,
                'active' => true,
            ]
        );
    }

    /**
     * @param StorageDTO $dto
     * @throws \App\Exception\NotFoundException
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(StorageDTO $dto)
    {
        $storage = $this->storageFactory->newInstance($dto);
        $this->repository->save($storage);
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
