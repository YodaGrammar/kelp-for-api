<?php

namespace App\DTOFactory;

use App\DTO\StorageDTO;

/**
 * Class StorageDTOFactory
 * @package App\DTOFactory
 */
class StorageDTOFactory implements DTOFactoryInterface
{
    /**
     * @return StorageDTO
     */
    public function newInstance(): StorageDTO
    {
        return new StorageDTO();
    }
}
