<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction(UserRepository $repository): Response
    {
        return $this->render('user/list.html.twig', [
            'users' => $repository->findAll(),
        ]);
    }
}
