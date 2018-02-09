<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StorageController extends Controller
{
    /**
     * Returns the list of programs.
     *
     * @param Request $request the current http request
     *
     * @return Response
     */
    public function listAction(Request $request):Response
    {
        return $this->render('storage/list.html.twig', [
//            'pager' => $programFilterFormHandler->process($request),
//            'form' => $programFilterFormHandler->getForm()->createView(),
        ]);
    }
}