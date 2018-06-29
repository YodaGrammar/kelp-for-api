<?php

namespace App\Factory\Entity;

interface EntityFactoryInterface
{
    public function newInstance($dto);
}
