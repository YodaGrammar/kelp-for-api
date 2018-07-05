<?php

namespace App\FormHandler;

use App\DTO\ProductDTO;
use App\Factory\Entity\ProductFactory;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StorageFormHandler.
 */
class ProductFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * ProductFormHandler constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ProductRepository    $repository
     * @param ProductFactory       $factory
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ProductRepository $repository,
        ProductFactory $factory
    ) {
        $this->form = $formFactory->createNamed('kelp_product', ProductType::class);
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param Request         $request
     * @param ProductDTO|null $productDTO
     *
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     *
     * @return bool
     */
    public function process(Request $request, ProductDTO $productDTO = null): bool
    {
        $this->form->setData($productDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';
            if (!$productDTO->id) {
                $productDTO->storage = $request->get('id');
                $function = 'add';
            }

            return $this->$function($productDTO);
        }

        return false;
    }
}
