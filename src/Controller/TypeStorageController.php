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
     * @param TypeStorageFilterFormHandler $typeStorageFilterFormHandler
     * @return Response
     */
    public function listAction(Request $request, TypeStorageFilterFormHandler $typeStorageFilterFormHandler): Response
    {
        return $this->render('type_storage/list.html.twig', [
            'pager' => $typeStorageFilterFormHandler->process($request),
            'form'  => $typeStorageFilterFormHandler->getForm()->createView(),
        ]);
    }

    /**
     * Creates a new program.
     *
     * @param Request $request the current http request
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

        return $this->render('type_storage/list.html.twig', []);
//        return $this->render('type_storage/create.html.twig', [
//            'form' => $programFormHandler->getForm()->createView(),
//        ]);
    }
}