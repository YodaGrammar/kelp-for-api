<?php

namespace App\DTOFactory;

use App\DTO\FilterTypeStorageDTO;

/**
 * Class FilterStorageDTOFactory
 * @package App\DTOFactory
 */
class FilterStorageDTOFactory implements DTOFactoryInterface
{
    /**
     * @return FilterTypeStorageDTO
     */
    public function newInstance()
    {
        return new FilterTypeStorageDTO();
    }

}