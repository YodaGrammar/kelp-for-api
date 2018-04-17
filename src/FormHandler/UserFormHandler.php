<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 01/03/2018
 * Time: 13:15.
 */

namespace App\FormHandler;

use App\Factory\DTO\UserDTOFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserFormHandler.
 */
class UserFormHandler implements FormHandlerInterface
{
    /**
     * @var UserDTOFactory
     */
    private $dtoFactory;

    /**
     * UserFormHandler constructor.
     *
     * @param UserDTOFactory $dtoFactory
     */
    public function __construct(
        UserDTOFactory $dtoFactory
    ) {
        $this->dtoFactory = $dtoFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function process(Request $request)
    {
    }


}
