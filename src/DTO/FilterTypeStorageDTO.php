<?php
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class FilterTypeStorageDTO
{
    /**
     *@Assert\NotNull
     */
    public $text;
}
