<?php

namespace App\FormHandler;

use App\DTO\StorageDTO;
use App\Form\StorageType;
use App\Repository\StorageRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Class StorageFormHandler.
 */
class StorageFormHandler
{
    use FormHandlerTrait;

    /**
     * @var StorageRepository
     */
    protected $repository;

    /**
     * StorageFormHandler constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param StorageRepository    $repository
     *
     * @throws InvalidOptionsException
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        StorageRepository $repository
    ) {
        $this->form = $formFactory->createNamed('kelp_storage', StorageType::class);
        $this->repository = $repository;
    }

    /**
     * @param Request         $request
     * @param StorageDTO|null $storageDTO
     *
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     *
     * @return bool
     */
    public function process(Request $request, StorageDTO $storageDTO = null): bool
    {
        $this->form->setData($storageDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if ($storageDTO && !$storageDTO->id) {
                $storageDTO->typeStorage = $request->get('id');
                $function = 'add';
            }

            return $this->repository->$function($storageDTO);
        }

        return false;
    }
}
