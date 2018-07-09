<?php

namespace App\FormHandler;

use App\Factory\Entity\EntityFactoryInterface;
use App\Repository\EntityRepositoryInterface;
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
