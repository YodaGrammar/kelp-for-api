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
     * @var EntityRepositoryInterface
     */
    protected $repository;

    /**
     * @var EntityFactoryInterface
     */
    protected $factory;

    /**
     * Get generated form.
     *
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param  $dto
     *
     * @return bool
     */
    protected function add($dto): bool
    {
        $instance = $this->factory->create($dto);

        if ($instance) {
            return true;
        }

        return false;
    }

    /**
     * @param $dto
     *
     * @return bool
     */
    protected function edit($dto): bool
    {
        $instance = $this->repository->edit($dto);

        if ($instance) {
            return true;
        }

        return false;
    }
}
