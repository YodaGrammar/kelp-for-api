<?php

namespace App\Form\Handler;

use App\Entity\Storage;
use App\Form\StorageType;
use App\Repository\StorageRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class StorageFormHandler
{
    use FormHandlerTrait;

    /**
     * @var StorageRepository
     */
    protected $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * StorageFormHandler constructor.
     *
     * @param FormFactoryInterface  $formFactory
     * @param StorageRepository     $repository
     * @param TokenStorageInterface $tokenStorage
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(FormFactoryInterface $formFactory, StorageRepository $repository, TokenStorageInterface $tokenStorage) {
        $this->form = $formFactory->createNamed('kelp_storage', StorageType::class);
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     * @param Storage $storage
     *
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request, Storage $storage): bool
    {
        $this->form->setData($storage);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $storage->setUser($this->tokenStorage->getToken()->getUser());

            if ($this->repository->createOrUpdate($storage)) {
                return true;
            }
        }
        return false;
    }
}
