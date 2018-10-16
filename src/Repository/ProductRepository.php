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
    /**
     * ProductRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param Product $product
     *
     * @return Product
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createOrUpdate(Product $product): Product
    {
        if ($product->getId() === null) {

            $this->getEntityManager()->persist($product);
        }
        $this->getEntityManager()->flush();

        return $product;
    }

    /**
     * @param Product $product
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Product $product): void
    {
        $product->setActive(false);

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
                        ->setParameter('idStorage', $idStorage)
                        ->andWhere('p.active = true');

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
                    ->andWhere('')
                    ->setParameter('user', $user)
                    ->orderBy('p.expirationDate', 'DESC')
                    ->getQuery()->getResult();
    }


}
