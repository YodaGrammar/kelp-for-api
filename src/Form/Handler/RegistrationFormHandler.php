<?php

namespace App\Form\Handler;


use App\DTO\UserDTO;
use App\Entity\User;
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

    public function __construct(
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $repository
    ) {
        $this->form = $formFactory->create( UserType::class);
        $this->passwordEncoder = $passwordEncoder;
        $this->repository = $repository;
    }


    public function process(Request $request): bool
    {
        $userDTO = new UserDTO();

        $this->form->setData($userDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $registerUser = new User();
            $registerUser->setEmail($userDTO->email);
            $registerUser->setFullName($userDTO->fullName);
            $registerUser->setUsername($userDTO->username);
            $password = $this->passwordEncoder->encodePassword($registerUser, $userDTO->plainPassword);
            $registerUser->setPassword($password);

            $this->repository->create($registerUser);

            return true;
        }

        return false;
    }
}