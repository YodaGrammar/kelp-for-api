<?php

namespace App\Controller;

use App\Entity\TypeStorage;
use App\FormHandler\TypeStorageFilterFormHandler;
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
     * @param Request $request
     * @param TypeStorageFilterFormHandler $formHandler
     * @return Response
     */
    public function listAction(Request $request, TypeStorageFilterFormHandler $formHandler): Response
    {
        return $this->render('type_storage/list.html.twig', [
            'pager' => $formHandler->process($request),
            'form'  => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @return Response
     */
    public function createAction()
    {
//        $program = new Program();
//        $program->setCreatedBy($userManager->findOneById($this->getUser()->getId()));
//
//        if ($programFormHandler->process($request, $program)) {
//        $this->addFlash(
//            'success',
//            $translator->trans(
//                'program.create.flash_message.validated',
//                ['%name%' => $program->getName()]
//            )
//        );
//
//            return $this->redirectToRoute('app_program_list');
//        }

        return $this->render('type_storage/create.html.twig', []);
//        return $this->render('type_storage/create.html.twig', [
//            'form' => $programFormHandler->getForm()->createView(),
//        ]);
    }
}
