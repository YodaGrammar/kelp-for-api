<?php

namespace App\Controller;

use App\Form\Handler\RegistrationFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class RegistrationController.
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param RegistrationFormHandler $formHandler
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, RegistrationFormHandler $formHandler, TranslatorInterface $translator)
    {
        if ($formHandler->process($request)) {
            $this->addFlash('success', $translator->trans('register.form.flash_message.success'));

            return $this->redirectToRoute('kelp.home');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $formHandler->getForm()->createView()
        ]);
    }
}
