<?php

namespace App\FormHandler;

use App\DTOFactory\FilterStorageDTOFactory;
use App\Form\FilterTypeStorageType;
use App\Mapper\StorageMapper;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class StorageFilterFormHandler
 * @package App\FormHandler
 */
class StorageFilterFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var TypeStorageMapper
     */
    protected $typeStorageMapper;

    /**
     * @var StorageMapper
     */
    protected $storageMapper;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * @var FilterStorageDTOFactory
     */
    protected $dtoFactory;

    /**
     * StorageFilterFormHandler constructor.
     * @param FilterStorageDTOFactory       $dtoFactory
     * @param TypeStorageMapper             $typeStorageMapper
     * @param StorageMapper                 $storageMapper
     * @param FormFactoryInterface          $factory
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FilterStorageDTOFactory $dtoFactory,
        TypeStorageMapper $typeStorageMapper,
        StorageMapper $storageMapper,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->dtoFactory           = $dtoFactory->newInstance();
        $this->typeStorageMapper    = $typeStorageMapper;
        $this->storageMapper        = $storageMapper;
        $this->form                 = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class,
            $this->dtoFactory
        );
        $this->tokenStorage         = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function process(Request $request): array
    {

        return ['typeStorages' => $this->typeStorageMapper->findAll()];
    }
}
