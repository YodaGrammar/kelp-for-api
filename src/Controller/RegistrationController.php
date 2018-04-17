<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 01/03/2018
 * Time: 13:11.
 */

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegistrationController.
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new UserDTO();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $registerUser = new User();
            $registerUser->setEmail($user->email);
            $registerUser->setUsername($user->username);
            $password = $passwordEncoder->encodePassword($registerUser, $user->plainPassword);
            $registerUser->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($registerUser);
            $entityManager->flush();

            return $this->redirectToRoute('kelp.home');
        }

        return $this->render(
            'registration/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
