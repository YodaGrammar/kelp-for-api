<?php

namespace App\Repository;

use App\Entity\TypeStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class TypeStorageRepository
 * @package App\Entity\Repository
 */
class TypeStorageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStorage::class);
    }

    /**
     * @param null $text
     * @param null $page
     * @param null $maxPage
     * @return mixed
     */
    public function findAllByFilters($text = null, $page = null, $maxPage = null)
    {
        $builder = $this->createQueryBuilder('tp');

        if ($text) {
            $builder
                ->andWhere('tp.label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
        if ($page) {
//            $builder
//                ->andWhere('tp.label like :text')
//                ->setParameter('text', '%' . $text . '%');
        }
        if ($maxPage) {
//            $builder
//                ->andWhere('tp.label like :text')
//                ->setParameter('text', '%' . $text . '%');
        }
        return $builder->getQuery()->getResult();
    }
}
