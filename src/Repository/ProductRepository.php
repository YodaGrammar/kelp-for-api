<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ProductRepository.
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product)
    {
        $this->getEntityManager()->persist($$product);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $idStorage
     *
     * @return mixed
     */
    public function findAllByStorageAndByFilters($idStorage)
    {
        $builder = $this->createQueryBuilder('p')
                        ->where('p.storage = :idStorage')
                        ->setParameter('idStorage', $idStorage);

        return $builder->getQuery()->getResult();
    }

    /**
     * @param $user
     *
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
