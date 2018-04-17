<?php

namespace App\DTO;

use App\Entity\Storage;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class StorageDTO.
 */
class StorageDTO
{
    /**
     * @var
     */
    public $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\D/")
     */
    public $label;

    /**
     * @Assert\Type("object")
     */
    public $typeStorage;

    /**
     * StorageDTO constructor.
     *
     * @param Storage $storage
     */
    public function __construct(Storage $storage = null)
    {
        if ($storage) {
            $this->id = $storage->getId();
            $this->label = $storage->getLabel();
            $this->typeStorage = $storage->getTypeStorage();
        }
    }
}
