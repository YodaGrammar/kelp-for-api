<?php

namespace App\Repository;

use App\DTO\ProductDTO;
use App\Entity\Product;
use App\Entity\Storage;
use App\Exception\NotFoundException;
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
     * @param Product $product
     * @param null    $idStorage
     *
     * @return Product
     * @throws NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createOrUpdate(Product $product, $idStorage = null): Product
    {
        if ($idStorage) {
            $storage = $this->getEntityManager()->getRepository(Storage::class)->find($idStorage);
            if (!$storage) {
                throw new NotFoundException('this storage does not exist');
            }
            $product->setStorage($storage);
            $product->setDateAdd(new \DateTime());
            $product->setActive(true);

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
                    ->setParameter('user', $user)
                    ->orderBy('p.date', 'DESC')->getQuery()->getResult();
    }
}
