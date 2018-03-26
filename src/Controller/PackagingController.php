<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/03/2018
 * Time: 11:28
 */

namespace App\Controller;

use App\FilterFormHandler\PackagingFilterFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PackagingController extends Controller
{
    /**
     * @param Request $request
     * @param PackagingFilterFormHandler $formHandler
     * @return Response
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function listAction(Request $request, PackagingFilterFormHandler $formHandler): Response
    {
        return $this->render('type_storage/list.html.twig', [
            'pager' => $formHandler->process($request),
            'form'  => $formHandler->getForm()->createView(),
        ]);
    }
}
