<?php

namespace App\Factory;

use App\Entity\Storage;

class StorageFactory
{
    public function create(): Storage
    {
        return new Storage();
    }
}
