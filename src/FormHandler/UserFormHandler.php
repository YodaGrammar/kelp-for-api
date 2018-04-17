<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 01/03/2018
 * Time: 13:15.
 */

namespace App\FormHandler;

use App\DTOFactory\UserDTOFactory;
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

    public function __construct(
        UserDTOFactory $dtoFactory
    ) {
        $this->dtoFactory = $dtoFactory;
    }

//    public function __construct(
//        FilterStorageDTOFactory $filterStorageDTOFactory,
//        TypeStorageMapper $typeStorageMapper,
//        StorageMapper $storageMapper,
//        FormFactoryInterface $factory,
//        TokenStorageInterface $tokenStorage,
//        AuthorizationCheckerInterface $authorizationChecker
//    )
    public function process(Request $request)
    {
        // TODO: Implement process() method.
    }
}
