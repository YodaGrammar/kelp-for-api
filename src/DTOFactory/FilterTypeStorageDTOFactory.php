<?php

namespace App\DTOFactory;

use App\DTO\FilterTypeStorageDTO;

/**
 * Class FilterTypeStorageDTOFactory
 * @package App\DTOFactory
 */
class FilterTypeStorageDTOFactory implements DTOFactoryInterface
{
    /**
     * @return FilterTypeStorageDTO
     */
    public function newInstance()
    {
        return new FilterTypeStorageDTO();
    }
}
