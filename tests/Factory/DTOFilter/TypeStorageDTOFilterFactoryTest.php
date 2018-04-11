<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 12:03
 */

namespace App\Tests\DTOFilterFactoryTest;


use App\DTO\Filter\TypeStorageDTOFilter;
use App\Factory\DTOFilter\TypeStorageDTOFilterFactory;
use PHPUnit\Framework\TestCase;

class TypeStorageDTOFilterFactoryTest extends TestCase
{
    public function testNewInstanceWithoutParam()
    {
        $dtoFactory = new TypeStorageDTOFilterFactory();
        $dto = $dtoFactory->newInstance();
        $this->isInstanceOf(TypeStorageDTOFilter::class, $dto);
    }
}