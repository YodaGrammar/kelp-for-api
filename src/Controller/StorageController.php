<?php

namespace App\Controller;

use App\Entity\Storage;
use App\Entity\TypeStorage;
use App\Factory\StorageFactory;
use App\FormHandler\Filter\StorageFilterFormHandler;
use App\Form\Handler\StorageFormHandler;
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
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param Request                  $request
     * @param StorageFilterFormHandler $formHandler
     *
     * @throws \LogicException
     *
     * @return Response
     */
    public function listAction(Request $request, StorageFilterFormHandler $formHandler): Response
    {
        return $this->render('storage/list.html.twig', [
                'pager' => $formHandler->process($request),
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param TypeStorage        $typeStorage
     * @param Request            $request
     * @param StorageFactory     $factory
     * @param StorageFormHandler $formHandler
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function createAction(TypeStorage $typeStorage, Request $request, StorageFactory $factory, StorageFormHandler $formHandler): Response {
        $storage = $factory->create();
        $storage->setTypeStorage($typeStorage);

        if ($formHandler->process($request, $storage)) {
            $this->addFlash(
                'success',
                $this->translator->trans(
                    'storage.create.flash_message.validated',
                    ['%name%' => $storage->getLabel()]
                )
            );

            return $this->redirectToRoute('kelp.storage.list');
        }

        return $this->render('storage/create.html.twig', [
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Storage            $storage
     * @param Request            $request
     * @param StorageFormHandler $formHandler
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function editAction(Storage $storage, Request $request, StorageFormHandler $formHandler): Response {
        if ($formHandler->process($request, $storage)) {
            $this->addFlash('success', $this->translator->trans(
                    'storage.edit.flash_message.validated',
                    ['%name%' => $storage->getLabel()]
                )
            );

            return $this->redirectToRoute('kelp.storage.list');
        }

        return $this->render('storage/edit.html.twig', [
                'form' => $formHandler->getForm()->createView(),
        ]);
    }

    /**
     * @param Storage             $storage
     * @param StorageRepository   $repository
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LogicException
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     *
     * @return Response
     */
    public function deleteAction(Storage $storage, StorageRepository $repository): Response {
        $repository->delete($storage);

        $this->addFlash(
            'success',
            $this->translator->trans(
                'storage.delete.flash_message.validated',
                ['%name%' => $storage->getLabel()]
            )
        );

        return $this->redirectToRoute('kelp.storage.list');
    }
}
