<?php

namespace App\Controller;

use App\FormHandler\Filter\TypeStorageFilterFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TypeStorageController.
 */
class TypeStorageController extends Controller
{
    /**
     * @param Request                      $request
     * @param TypeStorageFilterFormHandler $formHandler
     *
     * @return Response
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function listAction(Request $request, TypeStorageFilterFormHandler $formHandler): Response
    {
        return $this->render('type_storage/list.html.twig', [
            'pager' => $formHandler->process($request),
            'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @return Response
     *
     * @throws \LogicException
     */
    public function createAction()
    {
        return $this->render('type_storage/create.html.twig', []);;
    }
}
