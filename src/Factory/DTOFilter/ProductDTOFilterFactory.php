<?php

namespace App\Factory\DTOFilter;

use App\DTO\Filter\ProductDTOFilter;

/**
 * Class FilterStorageDTOFactory.
 */
class ProductDTOFilterFactory implements DTOFilterFactoryInterface
{
    /**
     * @return ProductDTOFilter
     */
    public function newInstance(): ProductDTOFilter
    {
        return new ProductDTOFilter();
    }
}
