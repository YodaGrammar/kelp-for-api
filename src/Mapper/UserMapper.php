<?php

namespace App\Mapper;

use App\Repository\StorageRepository;
use App\Entity\User;
use App\Factory\Entity\StorageFactory;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StorageMapper.
 */
class UserMapper
{
    /**
     * @var TypeStorageFactory
     */
    protected $storageFactory;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * StorageMapper constructor.
     * @param UserRepository $repository
     * @param StorageFactory $storageFactory
     */
    public function __construct(UserRepository $repository, StorageFactory $storageFactory)
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
     * @param $id
     *
     * @return null|object
     */
    public function findOneByid($id)
    {
        return $this->repository->find($id);
    }
}
