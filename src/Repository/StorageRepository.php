<?php

namespace App\Repository;

use App\Entity\Storage;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class StorageRepository.
 */
class StorageRepository extends ServiceEntityRepository
{
    /**
     * StorageRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Storage::class);
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function findAllByUser(User $user)
    {
        return $this->findBy(
            [
                'user'   => $user,
                'active' => true,
            ]
        );
    }

    /**
     * @param Storage $storage
     * @return Storage
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createOrUpdate(Storage $storage): Storage
    {
        if (null === $storage->getId()) {
            $this->getEntityManager()->persist($storage);
        }

        $this->getEntityManager()->flush();

        return $storage;
    }

    /**
     * @param Storage $storage
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Storage $storage): void
    {
        $storage->setActive(false);

        $this->getEntityManager()->flush();
    }
}
