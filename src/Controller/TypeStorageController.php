<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        return $this->renderView();
    }

    public function createAction()
    {

    }
}