<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class UserRepository
 * @package App\Entity\Repository
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findBySearch($name = null, $role = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();

        $builder
            ->select('user.username')
            ->from($this->getClassName(), 'user');

        if ($name !== null) {
            $builder
                ->where('user.username like :name or user.email like :name')
                ->setParameter('name', '%' . $name . '%');
        }

        if ($role !== null) {
            $builder
                ->where('user.roles  :role')
                ->setParameter('role', '%' . $role . '%');
        }
        return $builder->getQuery()->getResult();
    }
}
