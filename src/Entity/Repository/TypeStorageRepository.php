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
     * @param null $page
     * @param null $maxPage
     *
     * @return mixed
     */
    public function findAllByFilters($text = null, $page = null, $maxPage = null)
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
