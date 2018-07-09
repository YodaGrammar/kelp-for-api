<?php

namespace App\Tests\DTOFactoryTest;

use App\DTO\UserDTO;
use App\Factory\DTO\UserDTOFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserDTOFactoryTest
 * @package App\Tests\DTOFactoryTest
 */
class UserDTOFactoryTest extends TestCase
{
    public function testCreateWithoutParam(): void
    {
        $dtoFactory = new UserDTOFactory();
        $dto = $dtoFactory->create();
        $this->assertInstanceOf(UserDTO::class, $dto);
    }
}
