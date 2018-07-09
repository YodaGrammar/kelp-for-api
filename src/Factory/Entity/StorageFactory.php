<?php

namespace App\Factory\Entity;

use App\Entity\Storage;
use App\Entity\TypeStorage;
use App\Exception\NotFoundException;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class StorageFactory.
 */
class StorageFactory implements EntityFactoryInterface
{
    /** @var ManagerRegistry */
    protected $managerRegistry;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * StorageFactory constructor.
     *
     * @param ManagerRegistry       $managerRegistry
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ManagerRegistry $managerRegistry, TokenStorageInterface $tokenStorage)
    {
        $this->managerRegistry = $managerRegistry;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param $dto
     *
     * @return Storage|null
     * @throws NotFoundException
     */
    public function create($dto): ?Storage
    {
        $storage = new Storage();
        $storage->setLabel($dto->label);
        $storage->setUser($this->tokenStorage->getToken()->getUser());
        $typeStorage = $this->managerRegistry->getRepository(TypeStorage::class)->find($dto->typeStorage);
        if (!$typeStorage) {
            throw new NotFoundException('this type storage does not exist');
        }
        $storage->setTypeStorage($typeStorage);
        $storage->setActive(true);

        return $storage;
    }
}
