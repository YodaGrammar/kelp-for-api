<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class TypeStorageDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("alpha")
     */
    public $label;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\D/")
     */
    public $comment;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\D/")
     */
    public $class;
}
