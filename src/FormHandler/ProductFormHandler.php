<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 15/02/2018
 * Time: 13:29
 */

namespace App\FormHandler;

use App\DTO\ProductDTO;
use App\Form\ProductType;
use App\Mapper\ProductMapper;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StorageFormHandler
 * @package App\FormHandler
 */
class ProductFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var TypeStorageMapper
     */
    protected $mapper;

    /**
     * ProductFormHandler constructor.
     * @param FormFactoryInterface $factory
     * @param ProductMapper $mapper
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(FormFactoryInterface $factory, ProductMapper $mapper)
    {
        $this->form   = $factory->createNamed(
            'kelp_product',
            ProductType::class,
            null
        );
        $this->mapper = $mapper;
    }

    /**
     * @param Request $request
     * @param ProductDTO|null $productDTO
     * @return bool
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
            $this->mapper->$function($productDTO);

            return true;
        }

        return false;
    }
}
