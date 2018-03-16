<?php

namespace App\DTOFilterFactory;

use App\DTOFilter\StorageDTOFilter;


/**
 * Class FilterStorageDTOFactory
 * @package App\DTOFactory
 */
class StorageDTOFilterFactory implements DTOFilterFactoryInterface
{
    /**
     * @return StorageDTOFilter
     */
    public function newInstance():StorageDTOFilter
    {
        return new StorageDTOFilter();
    }
}
