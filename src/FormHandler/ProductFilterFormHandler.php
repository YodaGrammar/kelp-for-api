<?php

namespace App\FormHandler;

use App\DTOFilterFactory\ProductDTOFilterFactory;
use App\DTOFilterFactory\StorageDTOFilterFactory;
use App\Form\FilterTypeStorageType;
use App\Mapper\ProductMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class StorageFilterFormHandler
 * @package App\FormHandler
 */
class ProductFilterFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var ProductMapper
     */
    protected $productMapper;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var StorageDTOFilterFactory
     */
    protected $dtoFactory;

    /**
     * ProductFilterFormHandler constructor.
     * @param ProductDTOFilterFactory $dtoFactory
     * @param ProductMapper           $productMapper
     * @param FormFactoryInterface    $factory
     * @param TokenStorageInterface   $tokenStorage
     */
    public function __construct(
        ProductDTOFilterFactory $dtoFactory,
        ProductMapper $productMapper,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->dtoFactory           = $dtoFactory->newInstance();
        $this->productMapper    = $productMapper;
        $this->form                 = $factory->createNamed(
            'kelp_product_filter',
            FilterTypeStorageType::class,
            $this->dtoFactory
        );
        $this->tokenStorage         = $tokenStorage;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function process(Request $request): array
    {
        $filter = $this->dtoFactory;

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }

        $typeStorages = $this->productMapper->findAllByStorageAndByFilters($request->get('id'), $filter, $request->get('page', 1), self::MAX_PAGE);

        $pagination = [
            'page'        => $request->get('page', 1),
            'nbPages'     => ceil(count($typeStorages) / self::MAX_PAGE),
            'nomRoute'    => 'kelp.type_storage.list',
            'paramsRoute' => [],
        ];

        return [
            'pagination'   => $pagination,
            'products' => $products,
        ];
    }
}
