<?php

namespace App\Factory\DTOFilter;

use App\DTO\Filter\ProductDTOFilter;

/**
 * Class FilterStorageDTOFactory
 * @package App\DTOFactory
 */
class ProductDTOFilterFactory implements DTOFilterFactoryInterface
{
    /**
     * @return ProductDTOFilter
     */
    public function newInstance():ProductDTOFilter
    {
        return new ProductDTOFilter();
    }
}
