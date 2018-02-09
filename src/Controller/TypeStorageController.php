<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TypeStorageController
 * @package App\Controller
 */
class TypeStorageController extends Controller
{
    /**
     * @return Response
     * @throws \LogicException
     */
    public function listAction():Response
    {
        return $this->render('type_storage/list.html.twig', []);
    }

    /**
     * Creates a new program.
     *
     * @param Request             $request            the current http request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
//        $program = new Program();
//        $program->setCreatedBy($userManager->findOneById($this->getUser()->getId()));
//
//        if ($programFormHandler->process($request, $program)) {
//            $this->addFlash('success', $translator->trans('program.create.flash_message.validated', ['%name%' => $program->getName()]));
//
//            return $this->redirectToRoute('app_program_list');
//        }

        return $this->render('type_stotage/create.html.twig', [
            'form' => $programFormHandler->getForm()->createView(),
        ]);
    }
}