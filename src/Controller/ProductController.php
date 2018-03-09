<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 09/03/2018
 * Time: 12:01
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    public function createAction()
    {
        return $this->render(
            'product/create.html.twig',
            []
        );
    }
}
