<?php

namespace App\Controller;

use App\Entity\Packaging;
use App\Factory\DTO\PackagingDTOFactory;
use App\FormHandler\Filter\PackagingFilterFormHandler;
use App\FormHandler\PackagingFormHandler;
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
        return $this->render('packaging/list.html.twig', [
            'pager' => $formHandler->process($request),
            'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Packaging            $packaging
     * @param Request              $request
     * @param PackagingFormHandler $formHandler
     * @param TranslatorInterface  $translator
     * @param PackagingDTOFactory  $dtoFactory
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     *
     * @return Response
     */
    public function editAction(
        Packaging $packaging,
        Request $request,
        PackagingFormHandler $formHandler,
        TranslatorInterface $translator,
        PackagingDTOFactory $dtoFactory
    ): Response {
        $packagingDTO = $dtoFactory->newInstance($packaging);
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
}
