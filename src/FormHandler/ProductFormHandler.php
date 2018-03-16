<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 15/02/2018
 * Time: 13:29
 */

namespace App\FormHandler;

use App\DTO\StorageDTO;
use App\DTOFactory\StorageDTOFactory;
use App\Entity\Product;
use App\Form\StorageType;
use App\Mapper\StorageMapper;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class StorageFormHandler
 * @package App\FormHandler
 */
class ProductFormHandler
{
    use FormHandlerTrait;

    /**
     * @var TypeStorageMapper
     */
    protected $mapper;

    /**
     * ProductFormHandler constructor.
     * @param FormFactoryInterface $factory
     * @param ProductMapper        $mapper
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
     * @param Request         $request
     * @param ProductDTO|null $productDTO
     * @return bool
     */
    public function process(Request $request, ProductDTO $productDTO = null): bool
    {
        $this->form->setData($productDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if (!$productDTO->id) {
                $productDTO->typeStorage = $request->get('id');
                $function                = 'add';
            }
            $this->mapper->$function($productDTO);

            return true;
        }

        return false;
    }
}
