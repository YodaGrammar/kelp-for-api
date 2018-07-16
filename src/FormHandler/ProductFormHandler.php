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
     * @param Request      $request
     * @param Product $product
     *
     * @return bool
     * @throws \App\Exception\NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request, Product $product): bool
    {
        $this->form->setData($product);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            $idStorage = null;
            if($product->getId() === null) {
                $idStorage = $request->get('id');
            }

            if($this->repository->createOrUpdate($product, $idStorage)) {
                return true;
            }
        }

        return false;
    }
}
