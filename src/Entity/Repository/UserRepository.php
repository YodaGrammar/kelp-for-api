<?php

namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends EntityRepository
{
    public function findBySearch($name = null, $role = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();

        $builder
            ->select('user.username')
            ->from($this->getClassName(), 'user');

        if (null !== $name) {
            $builder
                ->where('user.username like :name or user.email like :name')
                ->setParameter('name', '%'.$name.'%');
        }

        if (null !== $role) {
            $builder
                ->where('user.roles  :role')
                ->setParameter('role', '%'.$role.'%');
        }

        return $builder->getQuery()->getResult();
    }
}
