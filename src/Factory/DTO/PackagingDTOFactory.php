<?php

namespace App\Factory\DTO;

use App\DTO\PackagingDTO;
use App\Entity\Packaging;

/**
 * Class PackagingDTOFactory.
 */
class PackagingDTOFactory
{
    /**
     * @param Packaging|null $packaging
     *
     * @return PackagingDTO
     */
    public function create(Packaging $packaging = null): PackagingDTO
    {
        return new PackagingDTO($packaging);
    }
}
