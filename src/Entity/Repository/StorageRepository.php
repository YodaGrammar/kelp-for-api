<?php

namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class StorageRepository
 * @package App\Entity\Repository
 */
class StorageRepository extends EntityRepository
{
    public function findAllByFilters($text = null, $page = null)
    {
        $builder = $this->createQueryBuilder('tp');

        if ($text) {
            $builder
                ->where('tp.label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
        if ($page) {
            $builder
                ->where('tp.label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
        return $builder->getQuery()->getResult();
    }
}
