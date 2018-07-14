<?php

namespace App\Factory\Entity;

use App\Entity\Product;
use App\Entity\Storage;
use App\Exception\NotFoundException;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class ProductFactory implements EntityFactoryInterface
{
    /**
     * @return Product
     */
    public function create(): Product
    {
        $product = new Product();

        return $product;
    }
}
