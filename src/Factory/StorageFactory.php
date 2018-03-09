<?php

namespace App\Factory;

use App\DTO\StorageDTO;
use App\Entity\Storage;
use App\Entity\TypeStorage;
use App\Exception\NotFoundException;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class StorageFactory
 * @package App\Factory
 */
class StorageFactory
{
    /** @var ObjectManager */
    protected $objectManager;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * StorageFactory constructor.
     * @param ObjectManager         $objectManager
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ObjectManager $objectManager, TokenStorageInterface $tokenStorage)
    {
        $this->objectManager = $objectManager;
        $this->tokenStorage  = $tokenStorage;
    }

    /**
     * @param StorageDTO $dto
     * @return Storage
     * @throws NotFoundException
     */
    public function newInstance(StorageDTO $dto): Storage
    {
        $storage = new Storage();
        $storage->setLabel($dto->getLabel());
        $storage->setUser($this->tokenStorage->getToken()->getUser());
        $typeStorage = $this->objectManager->getRepository(TypeStorage::class)->find($dto->getTypeStorage());
        if (!$typeStorage) {
            throw new NotFoundException('this type storage does not exist');
        }
        $storage->setTypeStorage($typeStorage);
        $this->objectManager->persist($storage);
        $this->objectManager->flush();

        return $storage;
    }
}
