<?php

namespace App\FormHandler;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FormHandlerInterface.
 */
interface FormHandlerInterface
{
    public function process(Request $request);
}
