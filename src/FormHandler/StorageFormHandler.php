<?php

namespace App\FormHandler;

use App\DTO\StorageDTO;
use App\Form\StorageType;
use App\Repository\StorageRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @param FormFactoryInterface $factory
     * @param StorageRepository    $repository
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(FormFactoryInterface $factory, StorageRepository $repository)
    {
        $this->form = $factory->createNamed('kelp_storage',StorageType::class);
        $this->repository = $repository;
    }

    /**
     * @param Request         $request
     * @param StorageDTO|null $storageDTO
     *
     * @return bool
     *
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request, StorageDTO $storageDTO = null): bool
    {
        $this->form->setData($storageDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if (!$storageDTO->id) {
                $storageDTO->typeStorage = $request->get('id');
                $function = 'add';
            }
            $this->repository->$function($storageDTO);

            return true;
        }

        return false;
    }
}
