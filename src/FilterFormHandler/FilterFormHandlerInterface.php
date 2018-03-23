<?php

namespace App\FilterFormHandler;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FormHandlerInterface
 * @package App\FormHandler
 */
interface FilterFormHandlerInterface
{
    public function process(Request $request);
}
