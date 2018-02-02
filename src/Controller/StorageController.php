<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StorageController extends Controller
{
    public function homeAction()
    {
        return $this->render('storage/home.html.twig');
    }
}