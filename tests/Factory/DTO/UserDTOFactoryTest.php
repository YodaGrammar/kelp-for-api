<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 11:01
 */

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
        $this->isInstanceOf(UserDTO::class, $dto);
    }
}