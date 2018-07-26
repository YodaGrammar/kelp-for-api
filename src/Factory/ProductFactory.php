<?php

namespace App\Factory;

use App\Entity\Product;

class ProductFactory
{
    public function create(): Product
    {
        return (new Product())
            ->setDateAdd(new \DateTime())
        ;
    }
}
