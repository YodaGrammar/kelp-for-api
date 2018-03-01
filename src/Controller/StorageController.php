<?php

namespace App\Controller;

use App\FormHandler\StorageFilterFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StorageController
 * @package App\Controller
 */
class StorageController extends Controller
{
    /**
     * Returns the list of programs.
     *
     * @param Request $request the current http request
     *
     * @return Response
     */
    public function listAction(Request $request, StorageFilterFormHandler $formHandler):Response
    {
        return $this->render('storage/list.html.twig', [
            'pager' => $formHandler->process($request),
//            'form' => $formHandler->getForm()->createView(),
        ]);
    }
}
