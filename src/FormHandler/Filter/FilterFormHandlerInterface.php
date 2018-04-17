<?php

namespace App\FormHandler\Filter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FormHandlerInterface.
 */
interface FilterFormHandlerInterface
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function process(Request $request);
}
