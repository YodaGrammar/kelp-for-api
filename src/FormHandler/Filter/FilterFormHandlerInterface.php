<?php

namespace App\FormHandler\Filter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FormHandlerInterface.
 */
interface FilterFormHandlerInterface
{
    public function process(Request $request);
}
