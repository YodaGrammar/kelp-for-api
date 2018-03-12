<?php

namespace App\Controller;

use App\DTOFactory\StorageDTOFactory;
use App\Entity\Storage;
use App\FormHandler\StorageFilterFormHandler;
use App\FormHandler\StorageFormHandler;
use App\Mapper\StorageMapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class StorageController
 * @package App\Controller
 */
class StorageController extends Controller
{
    /**
     * @param Request                  $request
     * @param StorageFilterFormHandler $formHandler
     * @return Response
     */
    public function listAction(Request $request, StorageFilterFormHandler $formHandler): Response
    {
        return $this->render(
            'storage/list.html.twig',
            [
                'pager' => $formHandler->process($request),
                //            'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    /**
     * @param Request             $request
     * @param StorageFormHandler  $formHandler
     * @param TranslatorInterface $translator
     * @param StorageDTOFactory   $dtoFactory
     * @return Response
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
     * @return Response
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
     * @param               $id
     * @param StorageMapper $mapper
     * @return string
     */
    public function deleteAction($id, StorageMapper $mapper)
    {
        $mapper->delete($id);

        return new Response($this->generateUrl('kelp.storage.list'));
    }
}
