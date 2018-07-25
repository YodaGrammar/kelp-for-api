<?php

namespace App\Form\Handler;

use App\Factory\UserFactory;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationFormHandler
{
    use FormHandlerTrait;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var UserFactory
     */
    private $factory;

    public function __construct(
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $repository,
        UserFactory $factory
    ) {
        $this->form = $formFactory->create( UserType::class);
        $this->passwordEncoder = $passwordEncoder;
        $this->repository = $repository;
        $this->factory = $factory;
    }


    public function process(Request $request): bool
    {
        $registerUser = $this->factory->create();

        $this->form->setData($registerUser);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $password = $this->passwordEncoder->encodePassword($registerUser, $registerUser->getPlainPassword());
            $registerUser->setPassword($password);

            $this->repository->create($registerUser);

            return true;
        }

        return false;
    }
}
