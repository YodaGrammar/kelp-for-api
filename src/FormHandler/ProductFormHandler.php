<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 15/02/2018
 * Time: 13:29.
 */

namespace App\FormHandler;

use App\DTO\ProductDTO;
use App\Form\ProductType;
use App\Mapper\ProductMapper;
use App\Mapper\TypeStorageMapper;
use App\Repository\ProductRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StorageFormHandler.
 */
class ProductFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var TypeStorageMapper
     */
    private $repository;

    /**
     * ProductFormHandler constructor.
     *
     * @param FormFactoryInterface $factory
     * @param ProductRepository        $repository
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(FormFactoryInterface $factory, ProductRepository $repository)
    {
        $this->form = $factory->createNamed(
            'kelp_product',
            ProductType::class,
            null
        );
        $this->repository = $repository;
    }

    /**
     * @param Request         $request
     * @param ProductDTO|null $productDTO
     *
     * @return bool
     *
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request, ProductDTO $productDTO = null): bool
    {
        $this->form->setData($productDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if (!$productDTO->id) {
                $productDTO->storage = $request->get('id');
                $function = 'add';
            }
            $this->repository->$function($productDTO);

            return true;
        }

        return false;
    }
}
