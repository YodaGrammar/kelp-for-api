<?php

namespace App\FormHandler\Filter;

use App\Factory\DTOFilter\StorageDTOFilterFactory;
use App\Form\Filter\FilterTypeStorageType;
use App\Mapper\StorageMapper;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class StorageFilterFormHandler
 * @package App\FormHandler
 */
class StorageFilterFormHandler implements FilterFormHandlerInterface
{
    use FilterFormHandlerTrait;

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
     * @var StorageDTOFilterFactory
     */
    protected $dtoFactory;

    /**
     * StorageFilterFormHandler constructor.
     * @param StorageDTOFilterFactory       $dtoFactory
     * @param TypeStorageMapper             $typeStorageMapper
     * @param StorageMapper                 $storageMapper
     * @param FormFactoryInterface          $factory
     * @param TokenStorageInterface         $tokenStorage
     */
    public function __construct(
        StorageDTOFilterFactory $dtoFactory,
        TypeStorageMapper $typeStorageMapper,
        StorageMapper $storageMapper,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage
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
    }

    /**
     * @param Request $request
     * @return array
     */
    public function process(Request $request): array
    {
        $request;
        return [
            'typeStorages' => $this->typeStorageMapper->findAll(),
            'storages' => $this->storageMapper->findAllByUser($this->tokenStorage->getToken()->getUser()),
        ];
    }
}
