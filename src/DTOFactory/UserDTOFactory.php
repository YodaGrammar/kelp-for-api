<?php

namespace App\DTOFactory;

use App\DTO\UserDTO;

/**
 * Class UserDTOFactory
 * @package App\DTOFactory
 */
class UserDTOFactory implements DTOFactoryInterface
{
    /**
     * @return UserDTO
     */
    public function newInstance():UserDTO
    {
        return new UserDTO();
    }
}
