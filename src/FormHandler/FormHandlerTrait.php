<?php

namespace App\FormHandler;

use Symfony\Component\Form\FormInterface;

trait FormHandlerTrait
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * Get generated form.
     *
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }
}
