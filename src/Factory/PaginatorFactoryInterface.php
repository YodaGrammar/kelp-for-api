<?php

namespace App\Factory;

interface PaginatorFactoryInterface
{
    public function newInstance($query);
}
