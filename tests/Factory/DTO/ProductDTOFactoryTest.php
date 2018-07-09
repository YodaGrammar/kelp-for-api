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
    /**
     * @return Void
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testCreateWithoutParam(): Void
    {
        $dtoFactory = new ProductDTOFactory();
        $dto = $dtoFactory->create();
        $this->assertInstanceOf(ProductDTO::class, $dto);
    }
}
