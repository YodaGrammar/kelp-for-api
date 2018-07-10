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
     * @param ProductDTO $dto
     *
     * @throws \App\Exception\NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return Product
     */
    public function create(ProductDTO $dto): Product
    {
        $product = $this->factory->create($dto);

        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();

        return $product;
    }

    /**
     * @param ProductDTO $dto
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     *
     * @return Product
     */
    public function edit(ProductDTO $dto): Product
    {
        if (null === ($product = $this->find($dto->id))) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $dto->id));
        }

        $product->setLabel($dto->label);
        $product->setQuantity($dto->quantity);
        $product->setPackaging($dto->packaging);
        if ($dto->date) {
            $product->setDatePeremption($dto->date);
        }
        $this->getEntityManager()->flush();

        return $product;
    }

    /**
     * @param $id
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     */
    public function delete($id): void
    {
        $product = $this->find($id);

        if (!$product) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $id));
        }
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
