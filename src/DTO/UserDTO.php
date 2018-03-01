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
 * @package App\DTO
 */
class UserDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotBlank()
     */
    public $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    public $plainPassword;
}
