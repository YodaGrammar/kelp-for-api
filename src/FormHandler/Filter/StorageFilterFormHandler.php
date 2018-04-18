<?php

namespace App\FormHandler\Filter;

use App\Form\Filter\FilterTypeStorageType;
use App\Repository\StorageRepository;
use App\Repository\TypeStorageRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class StorageFilterFormHandler.
 */
class StorageFilterFormHandler implements FilterFormHandlerInterface
{
    use FilterFormHandlerTrait;

    /**
     * @var TypeStorageRepository
     */
    protected $typeStorageRepository;

    /**
     * @var StorageRepository
     */
    protected $storageRepository;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;


    /**
     * StorageFilterFormHandler constructor.
     *
     * @param TypeStorageRepository $typeStorageRepository
     * @param StorageRepository     $storageRepository
     * @param FormFactoryInterface  $factory
     * @param TokenStorageInterface $tokenStorage
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(
        TypeStorageRepository $typeStorageRepository,
        StorageRepository $storageRepository,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->typeStorageRepository = $typeStorageRepository;
        $this->storageRepository     = $storageRepository;
        $this->form                  = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class
        );
        $this->tokenStorage          = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request): array
    {
        return [
            $request->get('page', 1),
            'typeStorages' => $this->typeStorageRepository->findAll(),
            'storages'     => $this->storageRepository->findAllByUser($this->tokenStorage->getToken()->getUser()),
        ];
    }
}
