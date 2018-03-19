<?php
namespace App\DTOFilter;

use Symfony\Component\Validator\Constraints as Assert;

class StorageDTOFilter
{
    /**
     *@Assert\NotNull
     */
    public $text;
}
