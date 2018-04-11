<?php

namespace App\Factory\DTOFilter;

use App\DTO\Filter\StorageDTOFilter;

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
