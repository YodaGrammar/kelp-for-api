<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 14/03/2018
 * Time: 10:11
 */

namespace App\Mapper;

use App\DTO\ProductDTO;
use App\Entity\Product;
use App\EntityFactory\ProductEntityFactory;
use Doctrine\Common\Persistence\ObjectManager;

class ProductMapper
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ProductEntityFactory
     */
    protected $productFactory;

    /**
     * ProductMapper constructor.
     * @param ObjectManager        $objectManager
     * @param ProductEntityFactory $productFactory
     */
    public function __construct(ObjectManager $objectManager, ProductEntityFactory $productFactory)
    {
        $this->objectManager  = $objectManager;
        $this->productFactory = $productFactory;
    }

    /**
     * @param ProductDTO $dto
     * @throws \App\Exception\NotFoundException
     */
    public function add(ProductDTO $dto)
    {
        $storage = $this->productFactory->newInstance($dto);
        $this->objectManager->persist($storage);
        $this->objectManager->flush();
    }

    public function findAllByStorageAndByFilters($idStorage, $filter, $page, $maxPage)
    {
        return $this->objectManager->getRepository(Product::class)
                            ->findAllByStorageAndByFilters($idStorage, $filter, $page, $maxPage);
    }
}
