<?php

namespace App\FormHandler\Filter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FormHandlerInterface
 * @package App\FormHandler
 */
interface FilterFormHandlerInterface
{
    public function process(Request $request);
}
