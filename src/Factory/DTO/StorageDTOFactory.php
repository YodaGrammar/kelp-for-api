<?php

namespace App\Factory\DTO;

use App\DTO\StorageDTO;
use App\Entity\Storage;

/**
 * Class StorageDTOFactory.
 */
class StorageDTOFactory
{
    /**
     * @param Storage $storage
     *
     * @return StorageDTO
     */
    public function create(Storage $storage = null): StorageDTO
    {
        return new StorageDTO($storage);
    }
}
