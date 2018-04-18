<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 28/03/2018
 * Time: 13:19
 */

namespace App\Repository;

use App\DTO\PackagingDTO;
use App\Entity\Packaging;
use App\Factory\PaginatorFactoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class PackagingRepository
 * @package App\Entity\Repository
 */
class PackagingRepository extends ServiceEntityRepository
{
    /** @var PaginatorFactoryInterface  */
    private $paginatorFactory;

    /**
     * PackagingRepository constructor.
     * @param ManagerRegistry           $registry
     * @param PaginatorFactoryInterface $paginatorFactory
     */
    public function __construct(ManagerRegistry $registry, PaginatorFactoryInterface $paginatorFactory)
    {
        parent::__construct($registry, Packaging::class);
        $this->paginatorFactory = $paginatorFactory;
    }

    /**
     * @param array|null $filter
     * @param null $page
     * @param null $maxPage
     * @return Paginator
     */
    public function findAllByFilters(array $filter = null, $page = null, $maxPage = null): ?Paginator
    {
        $builder = $this->createQueryBuilder('p');

        if ($filter['text']) {
            $builder
                ->andWhere('p.label like :text')
                ->setParameter('text', '%' . $filter['text'] . '%');
        }
        $query = $builder->getQuery();
        $paginator = null;
        if ($query !== null) {
            $firstResult = ($page - 1) * $maxPage;
            $query->setFirstResult($firstResult)->setMaxResults($maxPage);
            $paginator = $this->paginatorFactory->newInstance($query);
        }
        return $paginator;
    }

    /**
     * @param PackagingDTO $dto
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     */
    public function edit(PackagingDTO $dto): void
    {
        /** @var Packaging $packaging */
        $packaging = $this->find($dto->id);
        if (!$packaging) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $dto->id));
        }
        $packaging->setLabel($dto->label);
        $this->getEntityManager()->flush();
    }
}
