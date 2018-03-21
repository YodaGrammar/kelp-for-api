<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class DashboardController extends Controller
{
    /**
     * @return Response
     * @throws \LogicException
     */
    public function dashboardAction():Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }
}
