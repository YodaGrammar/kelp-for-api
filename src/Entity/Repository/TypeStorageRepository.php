<?php

namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TypeStorageRepository.
 */
class TypeStorageRepository extends EntityRepository
{
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
