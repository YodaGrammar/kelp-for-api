<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 09/03/2018
 * Time: 12:01
 */

namespace App\Controller;

use App\DTOFactory\ProductDTOFactory;
use App\FormHandler\ProductFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ProductController
 * @package App\Controller
 */
class ProductController extends Controller
{

    /**
     * @param Request             $request
     * @param ProductFormHandler  $formHandler
     * @param TranslatorInterface $translator
     * @param ProductDTOFactory   $dtoFactory
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(
        Request $request,
        ProductFormHandler $formHandler,
        TranslatorInterface $translator,
        ProductDTOFactory $dtoFactory
    ) {
        $productDTO = $dtoFactory->newInstance();

        if ($formHandler->process($request, $productDTO)) {
            $this->addFlash(
                'success',
                $translator->trans(
                    'storage.create.flash_message.validated',
                    ['%name%' => $productDTO->label]
                )
            );

            return $this->redirectToRoute('kelp.storage.list');
        }

        return $this->render(
            'product/create.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }
}
