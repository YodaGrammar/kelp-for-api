<?php

namespace App\FormHandler;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FormHandlerInterface
 * @package App\FormHandler
 */
interface FormHandlerInterface
{
    public function process(Request $request);
}