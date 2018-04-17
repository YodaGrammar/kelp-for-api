<?php

namespace App\Factory\DTO;

use App\DTO\ProductDTO;
use App\Entity\Product;

/**
 * Class ProductDTOFactory.
 */
class ProductDTOFactory
{
    /**
     * @param Product|null $product
     *
     * @return ProductDTO
     */
    public function newInstance(Product $product = null): ProductDTO
    {
        return new ProductDTO($product);
    }
}
