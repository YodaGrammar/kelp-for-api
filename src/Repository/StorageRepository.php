<?php

namespace App\Repository;

use App\Entity\Storage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class StorageRepository
 * @package App\Entity\Repository
 */
class StorageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Storage::class);
    }

    public function save(Storage $storage)
    {
        $this->getEntityManager()->persist($storage);
        $this->getEntityManager()->flush();
    }

    public function delete($id)
    {
        $storage = $this->getEntityManager()->find($id);

        if (null !== $storage) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $id));
        }

        $storage->setActive(false);

        $this->getEntityManager()->flush();
    }
}
