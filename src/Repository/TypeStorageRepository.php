<?php

namespace App\Repository;

use App\Entity\TypeStorage;
use App\Factory\PaginatorFactoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class TypeStorageRepository.
 */
class TypeStorageRepository extends ServiceEntityRepository
{
    /** @var PaginatorFactoryInterface */
    private $paginatorFactory;

    public function __construct(ManagerRegistry $registry, PaginatorFactoryInterface $paginatorFactory)
    {
        parent::__construct($registry, TypeStorage::class);
        $this->paginatorFactory = $paginatorFactory;
    }

    /**
     * @param array|null $filter
     * @param            $page
     * @param            $maxPage
     *
     * @return Paginator
     */
    public function findAllByFilters(array $filter = null, $page, $maxPage): Paginator
    {
        $builder = $this->createQueryBuilder('tp');

        if ($filter['text']) {
            $builder
                ->andWhere('tp.label like :text')
                ->setParameter('text', '%'.$filter['text'].'%');
        }
        $query = $builder->getQuery();
        $paginator = null;
        if (null !== $query) {
            $firstResult = ($page - 1) * $maxPage;
            $query->setFirstResult($firstResult)->setMaxResults($maxPage);
            $paginator = $this->paginatorFactory->newInstance($query);
        }

        return $paginator;
    }
}
