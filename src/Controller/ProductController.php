<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Storage;
use App\Factory\ProductFactory;
use App\FormHandler\Filter\ProductFilterFormHandler;
use App\Form\Handler\ProductFormHandler;
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
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

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
        return $this->render('product/list.html.twig', [
                'pager'   => $formHandler->process($request),
                'storage' => $storage,
                'form'    => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Storage $storage
     * @param Request $request
     * @param ProductFactory $factory
     * @param ProductFormHandler $formHandler
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAction(Storage $storage, Request $request, ProductFactory $factory, ProductFormHandler $formHandler)
    {
        $product = $factory->create();

        if ($formHandler->process($request, $product, $storage)) {
            $this->addFlash(
                'success',
                $this->translator->trans(
                    'product.create.flash_message.validated',
                    ['%name%' => $product->getLabel()]
                )
            );

            return $this->redirectToRoute('kelp.product.list', ['id' => $product->getStorage()->getId()]);
        }

        return $this->render('product/create.html.twig', [
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Product             $product
     * @param Request             $request
     * @param ProductFormHandler  $formHandler
     *
     * @return Response
     * @throws \App\Exception\NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function editAction(Product $product, Request $request, ProductFormHandler $formHandler): Response {
        if ($formHandler->process($request, $product)) {
            $this->addFlash(
                'success',
                $this->translator->trans(
                    'storage.edit.flash_message.validated',
                    ['%name%' => $product->getLabel()]
                )
            );

            return $this->redirectToRoute('kelp.product.list', ['id' => $product->getStorage()->getId()]);
        }

        return $this->render('product/edit.html.twig', [
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Product             $product
     * @param ProductRepository   $repository
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     *
     * @return Response
     */
    public function deleteAction(Product $product, ProductRepository $repository): Response {
        $repository->delete($product);

        $this->addFlash(
            'success',
            $this->translator->trans(
                'storage.delete.flash_message.validated',
                ['%name%' => $product->getLabel()]
            )
        );

        return $this->redirectToRoute('kelp.product.list', ['id' => $product->getStorage()->getId()]);
    }
}
