<?php

namespace App\DTOFactory;

use App\DTO\StorageDTO;
use App\Entity\Storage;

/**
 * Class StorageDTOFactory
 * @package App\DTOFactory
 */
class StorageDTOFactory
{
    /**
     * @param Storage $storage
     * @return StorageDTO
     */
    public function newInstance(Storage $storage = null): StorageDTO
    {
        return new StorageDTO($storage);
    }
}
