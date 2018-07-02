<?php

namespace App\FormHandler;

use App\DTO\PackagingDTO;
use App\Form\PackagingType;
use App\Repository\PackagingRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @param FormFactoryInterface $factory
     * @param PackagingRepository  $repository
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(FormFactoryInterface $factory, PackagingRepository $repository)
    {
        $this->form = $factory->createNamed('kelp_packaging', PackagingType::class);
        $this->repository = $repository;
    }

    /**
     * @param Request           $request
     * @param PackagingDTO|null $packagingDTO
     *
     * @throws \Doctrine\ORM\ORMException
     *
     * @return bool
     */
    public function process(Request $request, PackagingDTO $packagingDTO = null): bool
    {
        $this->form->setData($packagingDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if (!$packagingDTO->id) {
                $function = 'add';
            }
            $this->repository->$function($packagingDTO);

            return true;
        }

        return false;
    }
}
