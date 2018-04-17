<?php

namespace App\Factory\DTO;

use App\DTO\UserDTO;

/**
 * Class UserDTOFactory.
 */
class UserDTOFactory implements DTOFactoryInterface
{
    /**
     * @return UserDTO
     */
    public function newInstance(): UserDTO
    {
        return new UserDTO();
    }
}
