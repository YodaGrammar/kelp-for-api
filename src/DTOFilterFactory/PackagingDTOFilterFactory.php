<?php

namespace App\DTOFilterFactory;

use App\DTOFilter\PackagingDTOFilter;

/**
 * Class PackagingDTOFilterFactory
 * @package App\DTOFilterFactory
 */
class PackagingDTOFilterFactory implements DTOFilterFactoryInterface
{
    /**
     * @return PackagingDTOFilter
     */
    public function newInstance():PackagingDTOFilter
    {
        return new PackagingDTOFilter();
    }
}
