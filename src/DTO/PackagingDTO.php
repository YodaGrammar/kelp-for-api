<?php

namespace App\DTO;

use App\Entity\Packaging;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PackagingDTO.
 */
class PackagingDTO
{
    public $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\D/")
     */
    public $label;

    /**
     * PackagingDTO constructor.
     *
     * @param Packaging|null $packaging
     */
    public function __construct(Packaging $packaging = null)
    {
        if ($packaging) {
            $this->id = $packaging->getId();
            $this->label = $packaging->getLabel();
        }
    }
}
