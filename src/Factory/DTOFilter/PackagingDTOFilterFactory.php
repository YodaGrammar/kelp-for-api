<?php

namespace App\Factory\DTOFilter;

use App\DTO\Filter\PackagingDTOFilter;

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
