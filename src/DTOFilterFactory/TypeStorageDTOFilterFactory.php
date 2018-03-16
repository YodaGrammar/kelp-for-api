<?php

namespace App\DTOFilterFactory;

use App\DTOFilter\TypeStorageDTOFilter;


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
