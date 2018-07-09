<?php

namespace App\FormHandler;

use App\DTO\PackagingDTO;
use App\Form\PackagingType;
use App\Repository\PackagingRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Class StorageFormHandler.
 */
class PackagingFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var PackagingRepository
     */
    protected $repository;

    /**
     * PackagingFormHandler constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param PackagingRepository  $repository
     *
     * @throws InvalidOptionsException
     */
    public function __construct(FormFactoryInterface $formFactory, PackagingRepository $repository)
    {
        $this->form       = $formFactory->createNamed('kelp_packaging', PackagingType::class);
        $this->repository = $repository;
    }

    /**
     * @param Request           $request
     * @param PackagingDTO|null $packagingDTO
     *
     * @return bool
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request, PackagingDTO $packagingDTO = null): bool
    {
        $this->form->setData($packagingDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if ($packagingDTO &&!$packagingDTO->id) {
                $function = 'add';
            }

            return $this->repository->$function($packagingDTO);
        }

        return false;
    }
}
