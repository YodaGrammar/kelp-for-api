<?php

namespace App\Tests\DTOFactoryTest;

use App\DTO\ProductDTO;
use App\Entity\Product;
use App\Factory\DTO\ProductDTOFactory;
use App\Factory\Entity\ProductFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductDTOFactoryTest
 * @package App\Tests\DTOFactoryTest
 */
class ProductFactoryTest extends TestCase
{
    /**
     * @return Void
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testCreateWithoutParam(): Void
    {
        $factory = new ProductFactory();
        $dto = $factory->create();
        $this->assertInstanceOf(Product::class, $dto);
    }
}
