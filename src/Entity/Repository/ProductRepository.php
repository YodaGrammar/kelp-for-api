<?php

namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ProductRepository
 * @package App\Entity\Repository
 */
class ProductRepository extends EntityRepository
{
    /**
     * @param      $idStorage
     * @param null $filter
     * @param null $page
     * @param null $maxPage
     * @return mixed
     */
    public function findAllByStorageAndByFilters($idStorage, $filter = null, $page = null, $maxPage = null)
    {
        $builder = $this->createQueryBuilder('p')
                        ->where('p.storage = :idStorage')
                        ->setParameter('idStorage', $idStorage);

        if ($filter->text) {
//            $builder
//                ->andWhere('p.label like :text')
//                ->setParameter('text', '%' . $filter->text . '%');
        }
        if ($page) {
//            $builder
//                ->andWhere('tp.label like :text')
//                ->setParameter('text', '%' . $filter->text . '%');
        }
        if ($maxPage) {
//            $builder
//                ->andWhere('tp.label like :text')
//                ->setParameter('text', '%' . $filter->text . '%');
        }

        return $builder->getQuery()->getResult();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function findLastTenByUserOrderByDate($user)
    {
        return $this->createQueryBuilder('p')
                    ->where('p.user = :user')
                    ->setParameter('user', $user)
                    ->orderBy('p.date', 'DESC')->getQuery()->getResult();
    }
}
