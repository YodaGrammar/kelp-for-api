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
    public function newInstance(Storage $storage = null): StorageDTO
    {
        return new StorageDTO($storage);
    }
}
