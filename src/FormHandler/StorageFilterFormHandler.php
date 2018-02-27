<?php

namespace App\FormHandler;

use App\DTOFactory\FilterStorageDTOFactory;
use App\Form\FilterTypeStorageType;
use App\Mapper\StorageMapper;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

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
    protected $filterStorageDTOFactory;

    /**
     * TypeStorageFilterFormHandler constructor.
     * @param FormFactoryInterface $factory
     * @param FilterStorageDTOFactory $filterStorageDTOFactory
     * @param TypeStorageMapper $typeStorageMapper
     * @param StorageMapper $storageMapper
     */
    public function __construct(
                                FilterStorageDTOFactory $filterStorageDTOFactory,
                                TypeStorageMapper $typeStorageMapper,
                                StorageMapper $storageMapper,
                                FormFactoryInterface $factory
//                                TokenStorageInterface $tokenStorage,
//                                AuthorizationCheckerInterface $authorizationChecker
    )
    {
        $this->filterStorageDTOFactory = $filterStorageDTOFactory->newInstance();
        $this->typeStorageMapper = $typeStorageMapper;
        $this->storageMapper     = $storageMapper;
        $this->form                        = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class,
            $this->filterStorageDTOFactory
        );
//        $this->tokenStorage                = $tokenStorage;
//        $this->authorizationChecker        = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function process(Request $request):array
    {

        return ['typeStorages' => $this->typeStorageMapper->findAll()];
    }

}