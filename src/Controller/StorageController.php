<?php

namespace App\Controller;

use App\Entity\Storage;
use App\Factory\DTO\StorageDTOFactory;
use App\FormHandler\Filter\StorageFilterFormHandler;
use App\FormHandler\StorageFormHandler;
use App\Repository\StorageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class StorageController.
 */
class StorageController extends Controller
{
    /**
     * @param Request                  $request
     * @param StorageFilterFormHandler $formHandler
     *
     * @return Response
     *
     * @throws \LogicException
     */
    public function listAction(Request $request, StorageFilterFormHandler $formHandler): Response
    {
        return $this->render(
            'storage/list.html.twig',
            [
                'pager' => $formHandler->process($request),
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Request             $request
     * @param StorageFormHandler  $formHandler
     * @param TranslatorInterface $translator
     * @param StorageDTOFactory   $dtoFactory
     *
     * @return Response
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function createAction(
        Request $request,
        StorageFormHandler $formHandler,
        TranslatorInterface $translator,
        StorageDTOFactory $dtoFactory
    ): Response {
        $storageDTO = $dtoFactory->newInstance();

        if ($formHandler->process($request, $storageDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'storage.create.flash_message.validated',
                    ['%name%' => $storageDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.storage.list');
        }

        return $this->render(
            'storage/create.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Storage             $storage
     * @param Request             $request
     * @param StorageFormHandler  $formHandler
     * @param TranslatorInterface $translator
     * @param StorageDTOFactory   $dtoFactory
     *
     * @return Response
     *
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function editAction(
        Storage $storage,
        Request $request,
        StorageFormHandler $formHandler,
        TranslatorInterface $translator,
        StorageDTOFactory $dtoFactory
    ): Response {
        $storageDTO = $dtoFactory->newInstance($storage);
        $formHandler->getForm()->setData($storageDTO);
        if ($formHandler->process($request, $storageDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'storage.edit.flash_message.validated',
                    ['%name%' => $storageDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.storage.list');
        }

        return $this->render(
            'storage/edit.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Storage             $storage
     * @param StorageRepository   $repository
     * @param TranslatorInterface $translator
     *
     * @return Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function deleteAction(
        Storage $storage,
        StorageRepository $repository,
        TranslatorInterface $translator
    ): Response {
        $repository->delete($storage);

        $this->addFlash(
            'success',
            $translator->trans(
                'storage.delete.flash_message.validated',
                ['%name%' => $storage->getLabel()]
            )
        );

        return $this->redirectToRoute('kelp.storage.list');
    }
}
