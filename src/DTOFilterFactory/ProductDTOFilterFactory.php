<?php

namespace App\DTOFilterFactory;

use App\DTOFilter\ProductDTOFilter;

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
