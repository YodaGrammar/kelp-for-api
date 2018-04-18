<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 14/03/2018
 * Time: 10:11.
 */

namespace App\Mapper;

use App\DTO\ProductDTO;
use App\Factory\ProductFactory;
use App\Repository\ProductRepository;

class ProductMapper
{
    /**
     * @var ProductFactory
     */
    protected $productFactory;
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * ProductMapper constructor.
     * @param ProductRepository $repository
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductRepository $repository, ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
        $this->repository = $repository;
    }

    /**
     * @param ProductDTO $dto
     *
     * @throws \App\Exception\NotFoundException
     */
    public function add(ProductDTO $dto)
    {
        $product = $this->productFactory->newInstance($dto);
        $this->repository->save($product);
    }

    public function findAllByStorageAndByFilters($idStorage, $filter, $page, $maxPage)
    {
        return $this->repository
            ->findAllByStorageAndByFilters($idStorage, $filter, $page, $maxPage);
    }
}
