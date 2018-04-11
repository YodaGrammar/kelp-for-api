<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:59
 */

namespace App\Tests\DTOFactoryTest;


use App\DTO\StorageDTO;
use App\Factory\DTO\StorageDTOFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class StorageDTOFactoryTest
 * @package App\Tests\DTOFactoryTest
 */
class StorageDTOFactoryTest extends TestCase
{
    public function testNewInstanceWithoutParam()
    {
        $dtoFactory = new StorageDTOFactory();
        $dto = $dtoFactory->newInstance();
        $this->isInstanceOf(StorageDTO::class, $dto);
    }
}