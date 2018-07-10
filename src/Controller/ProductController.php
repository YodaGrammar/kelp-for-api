<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Storage;
use App\Factory\DTO\ProductDTOFactory;
use App\FormHandler\Filter\ProductFilterFormHandler;
use App\FormHandler\ProductFormHandler;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    /**
     * @param Storage                  $storage
     * @param Request                  $request
     * @param ProductFilterFormHandler $formHandler
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     *
     * @return Response
     */
    public function listAction(Storage $storage, Request $request, ProductFilterFormHandler $formHandler): Response
    {
        return $this->render(
            'product/list.html.twig',
            [
                'pager'   => $formHandler->process($request),
                'storage' => $storage,
                'form'    => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Request             $request
     * @param ProductFormHandler  $formHandler
     * @param TranslatorInterface $translator
     * @param ProductDTOFactory   $dtoFactory
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(
        Request $request,
        ProductFormHandler $formHandler,
        TranslatorInterface $translator,
        ProductDTOFactory $dtoFactory
    ) {
        $productDTO = $dtoFactory->create();

        if ($formHandler->process($request, $productDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'product.create.flash_message.validated',
                    ['%name%' => $productDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.product.list', ['id' => $productDTO->storage]);
        }

        return $this->render(
            'product/create.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Product             $product
     * @param Request             $request
     * @param ProductFormHandler  $formHandler
     * @param TranslatorInterface $translator
     * @param ProductDTOFactory   $dtoFactory
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     *
     * @return Response
     */
    public function editAction(
        Product $product,
        Request $request,
        ProductFormHandler $formHandler,
        TranslatorInterface $translator,
        ProductDTOFactory $dtoFactory
    ): Response {
        $productDTO = $dtoFactory->create($product);
        $formHandler->getForm()->setData($productDTO);
        if ($formHandler->process($request, $productDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'storage.edit.flash_message.validated',
                    ['%name%' => $productDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.product.list', ['id' => $product->getStorage()->getId()]);
        }

        return $this->render(
            'product/edit.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Product             $product
     * @param ProductRepository   $repository
     * @param TranslatorInterface $translator
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     *
     * @return Response
     */
    public function deleteAction(
        Product $product,
        ProductRepository $repository,
        TranslatorInterface $translator
    ): Response {
        $repository->delete($product);

        $this->addFlash(
            'success',
            $translator->trans(
                'storage.delete.flash_message.validated',
                ['%name%' => $product->getLabel()]
            )
        );

        return $this->redirectToRoute('kelp.product.list', ['id' => $product->getStorage()->getId()]);
    }
}
