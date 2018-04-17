<?php

namespace App\Mapper;

use App\Entity\Repository\StorageRepository;
use App\Entity\User;
use App\Factory\Entity\StorageFactory;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StorageMapper.
 */
class UserMapper
{
    /**
     * @var ObjectManager
     */
    protected $managerRegistry;

    /**
     * @var StorageFactory
     */
    protected $storageFactory;

    /**
     * UserMapper constructor.
     *
     * @param ManagerRegistry $managerRegistry
     * @param StorageFactory  $storageFactory
     */
    public function __construct(ManagerRegistry $managerRegistry, StorageFactory $storageFactory)
    {
        $this->managerRegistry = $managerRegistry;
        $this->storageFactory = $storageFactory;
    }

    /**
     * @return StorageRepository
     */
    protected function getRepository(): StorageRepository
    {
        return $this->managerRegistry->getRepository(User::class);
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
     *
     * @return null|object
     */
    public function findOneByid($id)
    {
        return $this->getRepository()->find($id);
    }
}
