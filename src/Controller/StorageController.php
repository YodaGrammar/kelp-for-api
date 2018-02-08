<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StorageController extends Controller
{
    /**
     * @return Response
     * @throws \LogicException
     */
    public function homeAction():Response
    {
        return $this->render('storage/home.html.twig');
    }
}