<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:54
 */

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
        $this->isInstanceOf(ProductDTO::class, $dto);
    }
}