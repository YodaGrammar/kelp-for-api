<?php

namespace App\Factory\DTOFilter;

use App\DTO\Filter\TypeStorageDTOFilter;

/**
 * Class FilterTypeStorageDTOFactory
 * @package App\DTOFactory
 */
class TypeStorageDTOFilterFactory implements DTOFilterFactoryInterface
{
    /**
     * @return TypeStorageDTOFilter
     */
    public function newInstance():TypeStorageDTOFilter
    {
        return new TypeStorageDTOFilter();
    }
}
