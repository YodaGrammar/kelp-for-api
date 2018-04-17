<?php
/**
 * Created by PhpStorm.
 * User: groot
 * Date: 07/04/2017
 * Time: 16:01.
 */

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
