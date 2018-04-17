<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 28/03/2018
 * Time: 13:19
 */

namespace App\Repository;

use App\Entity\Packaging;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PackagingRepository
 * @package App\Entity\Repository
 */
class PackagingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Packaging::class);
    }

    /**
     * @param null $filter
     * @param null $page
     * @param null $maxPage
     * @return mixed
     */
    public function findAllByStorageAndByFilters($filter = null, $page = null, $maxPage = null)
    {
        $builder = $this->createQueryBuilder('p');

        if ($filter->text) {
//            $builder
//                ->andWhere('p.label like :text')
//                ->setParameter('text', '%' . $filter->text . '%');
        }
        if ($page) {
//            $builder
//                ->andWhere('tp.label like :text')
//                ->setParameter('text', '%' . $filter->text . '%');
        }
        if ($maxPage) {
//            $builder
//                ->andWhere('tp.label like :text')
//                ->setParameter('text', '%' . $filter->text . '%');
        }

        return $builder->getQuery()->getResult();
    }
}