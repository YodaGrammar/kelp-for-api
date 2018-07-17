<?php

namespace App\FormHandler;

use App\DTO\ProductDTO;;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Class StorageFormHandler.
 */
class ProductFormHandler
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
     * @param Request $request
     * @param Product $product
     * @param null    $storage
     *
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request, Product $product, $storage = null): bool
    {
        $this->form->setData($product);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            if($storage) {
                $product->setStorage($storage);
            }

            if($this->repository->createOrUpdate($product)) {
                return true;
            }
        }

        return false;
    }
}
