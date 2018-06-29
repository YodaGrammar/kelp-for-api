<?php

namespace App\Tests\DTOFactoryTest;

use App\DTO\ProductDTO;
use App\Factory\DTO\ProductDTOFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductDTOFactoryTest
 * @package App\Tests\DTOFactoryTest
 */
class ProductDTOFactoryTest extends TestCase
{
    public function testNewInstanceWithoutParam(): Void
    {
        $dtoFactory = new ProductDTOFactory();
        $dto = $dtoFactory->newInstance();
        $this->assertInstanceOf(ProductDTO::class, $dto);
    }
}
