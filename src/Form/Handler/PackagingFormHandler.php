<?php

namespace App\Form\Handler;

use App\Entity\Packaging;
use App\Form\PackagingType;
use App\Repository\PackagingRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Class StorageFormHandler.
 */
class PackagingFormHandler
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
     * @param Request $request
     * @param Packaging|null $packaging
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(Request $request, Packaging $packaging = null): bool
    {
        $this->form->setData($packaging);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            if($this->repository->createOrUpdate($packaging)) {
                return true;
            }
        }

        return false;
    }
}
