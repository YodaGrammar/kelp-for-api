<?php
/**
 * Created by PhpStorm.
 * User: groot
 * Date: 07/04/2017
 * Time: 16:01
 */

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserDTO
 *
 * @package Kelp\AppBundle\DTO
 */
class UserDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("array")
     */
    public $roles;
}
