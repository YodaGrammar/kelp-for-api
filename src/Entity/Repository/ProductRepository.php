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
     * @param null $text
     * @param null $page
     * @param null $maxPage
     * @return mixed
     */
    public function findAllByStorageAndByFilters($idStorage, $text = null, $page = null, $maxPage = null)
    {
        $builder = $this->createQueryBuilder('p')
        ->where()
        ->setParameter();

        if ($text) {
            $builder
                ->andWhere('tp.label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
        if ($page) {
            $builder
                ->andWhere('tp.label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
        if ($maxPage) {
            $builder
                ->andWhere('tp.label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
        return $builder->getQuery()->getResult();
    }
}