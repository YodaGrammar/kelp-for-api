<?php

namespace App\Repository;

use App\Entity\Packaging;
use App\Factory\PaginatorFactoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class PackagingRepository.
 */
class PackagingRepository extends ServiceEntityRepository implements EntityRepositoryInterface
{
    /** @var PaginatorFactoryInterface */
    private $paginatorFactory;

    /**
     * PackagingRepository constructor.
     *
     * @param ManagerRegistry           $registry
     * @param PaginatorFactoryInterface $paginatorFactory
     */
    public function __construct(
        ManagerRegistry $registry,
        PaginatorFactoryInterface $paginatorFactory
    ) {
        parent::__construct($registry, Packaging::class);
        $this->paginatorFactory = $paginatorFactory;
    }

    /**
     * @param array|null $filter
     * @param null       $page
     * @param null       $maxPage
     *
     * @return Paginator
     */
    public function findAllByFilters(array $filter = null, $page = null, $maxPage = null): ?Paginator
    {
        $builder = $this->createQueryBuilder('p');

        if ($filter['text']) {
            $builder
                ->andWhere('p.label like :text')
                ->setParameter('text', '%'.$filter['text'].'%');
        }
        $query = $builder->getQuery();
        $paginator = null;
        if (null !== $query) {
            $firstResult = ($page - 1) * $maxPage;
            $query->setFirstResult($firstResult)->setMaxResults($maxPage);
            $paginator = $this->paginatorFactory->create($query);
        }

        return $paginator;
    }

    /**
     * @param $dto
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return Packaging|null
     */
    public function edit($dto): ?Packaging
    {
        /** @var Packaging $packaging */
        $packaging = $this->find($dto->id);
        if (!$packaging) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $dto->id));
        }
        $packaging->setLabel($dto->label);
        $this->getEntityManager()->flush();

        return $packaging;
    }
}
