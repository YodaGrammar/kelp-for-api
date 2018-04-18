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
    protected $tsRepository;

    /**
     * @var StorageRepository
     */
    protected $repository;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * StorageFilterFormHandler constructor.
     *
     * @param TypeStorageRepository $tsRepository
     * @param StorageRepository     $repository
     * @param FormFactoryInterface  $factory
     * @param TokenStorageInterface $tokenStorage
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(
        TypeStorageRepository $tsRepository,
        StorageRepository $repository,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->tsRepository = $tsRepository;
        $this->repository = $repository;
        $this->form = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class
        );
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request): array
    {
        return [
            $request->get('page', 1),
            'typeStorages' => $this->tsRepository->findAll(),
            'storages' => $this->repository->findAllByUser($this->tokenStorage->getToken()->getUser()),
        ];
    }
}
