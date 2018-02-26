<?php

namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TypeStorageRepository
 * @package App\Entity\Repository
 */
class TypeStorageRepository extends EntityRepository
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

    public function findBySearch($text = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();

        $class = $this->getClassName();

        if (strstr($this->getClassName(), '\\')) {
            $class = explode("\\", $class);
            $class = end($class);
        }

        $builder
            ->select('type_storage.label')
            ->from($this->getClassName(), $class);

        if ($text !== null) {
            $builder
                ->where('type_storage   .label like :text')
                ->setParameter('text', '%' . $text . '%');
        }
    }
}
