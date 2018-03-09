<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class StorageDTO
 *
 * @package Kelp\AppBundle\DTO
 */
class StorageDTO
{
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\D/")
     */
    protected $label;

    /**
     * @Assert\Type("object")
     */
    protected $typeStorage;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getTypeStorage()
    {
        return $this->typeStorage;
    }

    /**
     * @param mixed $typeStorage
     */
    public function setTypeStorage($typeStorage): void
    {
        $this->typeStorage = $typeStorage;
    }
}
