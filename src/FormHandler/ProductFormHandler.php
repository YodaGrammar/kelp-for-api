<?php

namespace App\FormHandler;

use App\DTO\ProductDTO;;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Class StorageFormHandler.
 */
class ProductFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * ProductFormHandler constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ProductRepository    $repository
     *
     * @throws InvalidOptionsException
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ProductRepository $repository
    ) {
        $this->form = $formFactory->createNamed('kelp_product', ProductType::class);
        $this->repository = $repository;
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
            if ($productDTO &&!$productDTO->id) {
                $productDTO->storage = $request->get('id');
                $function = 'create';
            }

            if($this->repository->$function($productDTO)) {
                return true;
            }
        }

        return false;
    }
}
