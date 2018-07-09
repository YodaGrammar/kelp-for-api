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
    public function create(): UserDTO
    {
        return new UserDTO();
    }
}
