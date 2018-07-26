<?php

namespace App\Controller;

use App\Entity\Packaging;
use App\Factory\PackagingFactory;
use App\FormHandler\Filter\PackagingFilterFormHandler;
use App\Form\Handler\PackagingFormHandler;
use App\Repository\PackagingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class PackagingController.
 */
class PackagingController extends Controller
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
     * @param Request                    $request
     * @param PackagingFilterFormHandler $formHandler
     *
     * @throws \LogicException
     *
     * @return Response
     */
    public function listAction(Request $request, PackagingFilterFormHandler $formHandler): Response
    {
        return $this->render('packaging/list.html.twig', [
                'pager' => $formHandler->process($request),
                'form'  => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param PackagingFactory $factory
     * @param PackagingFormHandler $formHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAction(Request $request, PackagingFactory $factory, PackagingFormHandler $formHandler) {
        $packaging = $factory->create();

        if ($formHandler->process($request, $packaging)) {
            $this->addFlash(
                'success',
                $this->translator->trans(
                    'packaging.create.flash_message.validated',
                    ['%name%' => $packaging->getLabel()]
                )
            );

            return $this->redirectToRoute('kelp.packaging.list');
        }

        return $this->render('packaging/create.html.twig', [
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Packaging $packaging
     * @param Request $request
     * @param PackagingFormHandler $formHandler
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction(Packaging $packaging, Request $request, PackagingFormHandler $formHandler): Response {
        if ($formHandler->process($request, $packaging)) {
            $this->addFlash(
                'success',
                $this->translator->trans(
                    'packaging.edit.flash_message.validated',
                    ['%name%' => $packaging->getLabel()]
                )
            );

            return $this->redirectToRoute('kelp.packaging.list');
        }

        return $this->render('packaging/edit.html.twig', [
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Packaging           $packaging
     * @param PackagingRepository $repository
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function deleteAction(Packaging $packaging, PackagingRepository $repository): Response {
        $repository->delete($packaging);

        $this->addFlash(
            'success',
            $this->translator->trans(
                'packaging.delete.flash_message.validated',
                ['%name%' => $packaging->getLabel()]
            )
        );

        return $this->redirectToRoute('kelp.storage.list');
    }
}
