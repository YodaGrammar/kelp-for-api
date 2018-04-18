<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:32.
 */

namespace App\Mapper;

use App\DTOFilter\PackagingDTOFilter;
use App\Repository\PackagingRepository;
use App\Factory\PackagingFactory;

/**
 * Class PackagingMapper
 * @package App\Mapper
 * @deprecated
 */
class PackagingMapper
{
    /**
     * @var PackagingFactory
     */
    protected $packagingFactory;

    /**
     * @var PackagingRepository
     */
    private $repository;

    /**
     * @param PackagingRepository $repository
     * @param PackagingFactory $packagingFactory
     */
    public function __construct(PackagingRepository $repository, PackagingFactory $packagingFactory)
    {
        $this->packagingFactory = $packagingFactory;
        $this->repository = $repository;
    }

    /**
     * @param PackagingDTOFilter $packagingDTO
     * @param                    $page
     * @param                    $maxPage
     *
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function findAllByFilters(PackagingDTOFilter $packagingDTO, $page, $maxPage)
    {
        return $this->repository->findAllByFilters($packagingDTO->text, $page, $maxPage);
    }
}
