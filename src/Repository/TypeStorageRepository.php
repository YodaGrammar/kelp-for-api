<?php

namespace App\Repository;

use App\Entity\TypeStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class TypeStorageRepository.
 */
class TypeStorageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStorage::class);
    }

    /**
     * @param null $text
     *
     * @return mixed
     */
    public function findAllByFilters($text = null)
    {
        $builder = $this->createQueryBuilder('tp');

        if ($text) {
            $builder
                ->andWhere('tp.label like :text')
                ->setParameter('text', '%'.$text.'%');
        }

        return $builder->getQuery()->getResult();
    }
}
