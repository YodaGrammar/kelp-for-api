<?php
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserTypeStorageDTO
 *
 * @package Kelp\AppBundle\DTO
 */
class UserTypeStorageDTO
{
    /**
     * @Assert\NotBlank()
     */
    //* @Assert\Type("ArrayCollection")
    public $label = [];
}
