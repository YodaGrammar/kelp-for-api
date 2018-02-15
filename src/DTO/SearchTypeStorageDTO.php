<?php
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class SearchTypeStorageDTO
{
    /**
     *@Assert\NotNull
     */
    public $text;
}
