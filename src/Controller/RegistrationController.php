<?php

namespace App\Controller;

use App\Form\Handler\RegistrationFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegistrationController.
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param RegistrationFormHandler $formHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, RegistrationFormHandler $formHandler)
    {
        if ($formHandler->process($request)) {
            return $this->redirectToRoute('kelp.home');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $formHandler->getForm()->createView()
        ]);
    }
}
