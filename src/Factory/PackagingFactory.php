<?php

namespace App\Factory;

use App\Entity\Packaging;

class PackagingFactory
{
    public function create(): Packaging
    {
        return new Packaging();
    }
}
