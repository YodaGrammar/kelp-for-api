<?php
namespace App\DTOFilter;

use Symfony\Component\Validator\Constraints as Assert;

class TypeStorageDTOFilter
{
    /**
     *@Assert\NotNull
     */
    public $text;
}
