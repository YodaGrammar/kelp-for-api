<?php

namespace App\DTOFilterFactory;

use App\DTO\Filter\ProductDTOFilter;
use App\Factory\DTOFilter\ProductDTOFilterFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class FilterStorageDTOFactory
 * @package App\DTOFactory
 */
class ProductDTOFilterFactoryTest extends TestCase
{
    public function testNewInstanceWithoutParam()
    {
        $dtoFactory = new ProductDTOFilterFactory();
        $dto = $dtoFactory->newInstance();
        $this->isInstanceOf(ProductDTOFilter::class, $dto);
    }

}
