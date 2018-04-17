<?php

namespace App\Factory\DTOFilter;

use App\DTO\Filter\StorageDTOFilter;

/**
 * Class FilterStorageDTOFactory.
 */
class StorageDTOFilterFactory implements DTOFilterFactoryInterface
{
    /**
     * @return StorageDTOFilter
     */
    public function newInstance(): StorageDTOFilter
    {
        return new StorageDTOFilter();
    }
}
