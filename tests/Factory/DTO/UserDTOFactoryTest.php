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
    public function testNewInstanceWithoutParam()
    {
        $dtoFactory = new UserDTOFactory();
        $dto = $dtoFactory->newInstance();
        $this->assertInstanceOf(UserDTO::class, $dto);
    }
}
