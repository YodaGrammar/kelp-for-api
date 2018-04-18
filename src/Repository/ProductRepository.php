<?php

namespace App\Repository;

use App\DTO\ProductDTO;
use App\Entity\Product;
use App\Factory\Entity\ProductFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ProductRepository.
 */
class ProductRepository extends ServiceEntityRepository
{
    /** @var ProductFactory */
    private $factory;

    /**
     * ProductRepository constructor.
     *
     * @param ManagerRegistry $registry
     * @param ProductFactory  $factory
     */
    public function __construct(ManagerRegistry $registry, ProductFactory $factory)
    {
        parent::__construct($registry, Product::class);
        $this->factory = $factory;
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

    /**
     * @param ProductDTO $dto
     *
     * @throws \App\Exception\NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(ProductDTO $dto): void
    {
        $product = $this->factory->newInstance($dto);
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }
}
