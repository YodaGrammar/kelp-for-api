<?php

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
    public function testCreateWithoutParam(): void
    {
        $dtoFactory = new StorageDTOFactory();
        $dto = $dtoFactory->create();
        $this->assertInstanceOf(StorageDTO::class, $dto);
    }
}
