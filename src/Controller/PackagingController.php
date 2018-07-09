<?php

namespace App\Controller;

use App\Entity\Packaging;
use App\Factory\DTO\PackagingDTOFactory;
use App\FormHandler\Filter\PackagingFilterFormHandler;
use App\FormHandler\PackagingFormHandler;
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
     * @param Request                    $request
     * @param PackagingFilterFormHandler $formHandler
     *
     * @throws \LogicException
     *
     * @return Response
     */
    public function listAction(Request $request, PackagingFilterFormHandler $formHandler): Response
    {
        return $this->render(
            'packaging/list.html.twig',
            [
                'pager' => $formHandler->process($request),
                'form'  => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Request              $request
     * @param PackagingFormHandler $formHandler
     * @param TranslatorInterface  $translator
     * @param PackagingDTOFactory  $dtoFactory
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function createAction(
        Request $request,
        PackagingFormHandler $formHandler,
        TranslatorInterface $translator,
        PackagingDTOFactory $dtoFactory
    ) {
        $packagingDTO = $dtoFactory->create();

        if ($formHandler->process($request, $packagingDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'packaging.create.flash_message.validated',
                    ['%name%' => $packagingDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.packaging.list');
        }

        return $this->render(
            'packaging/create.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Packaging            $packaging
     * @param Request              $request
     * @param PackagingFormHandler $formHandler
     * @param TranslatorInterface  $translator
     * @param PackagingDTOFactory  $dtoFactory
     *
     * @return Response
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function editAction(
        Packaging $packaging,
        Request $request,
        PackagingFormHandler $formHandler,
        TranslatorInterface $translator,
        PackagingDTOFactory $dtoFactory
    ): Response {
        $packagingDTO = $dtoFactory->create($packaging);
        $formHandler->getForm()->setData($packagingDTO);
        if ($formHandler->process($request, $packagingDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'packaging.edit.flash_message.validated',
                    ['%name%' => $packagingDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.packaging.list');
        }

        return $this->render(
            'packaging/edit.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Packaging           $packaging
     * @param PackagingRepository $repository
     * @param TranslatorInterface $translator
     *
     * @return Response
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function deleteAction(
        Packaging $packaging,
        PackagingRepository $repository,
        TranslatorInterface $translator
    ): Response {
        $repository->delete($packaging);

        $this->addFlash(
            'success',
            $translator->trans(
                'packaging.delete.flash_message.validated',
                ['%name%' => $packaging->getLabel()]
            )
        );

        return $this->redirectToRoute('kelp.storage.list');
    }
}
