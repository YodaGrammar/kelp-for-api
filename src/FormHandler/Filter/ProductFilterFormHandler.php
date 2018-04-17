<?php

namespace App\FormHandler\Filter;

use App\Factory\DTOFilter\ProductDTOFilterFactory;
use App\Factory\DTOFilter\StorageDTOFilterFactory;
use App\Form\Filter\FilterProductType;
use App\Mapper\ProductMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class StorageFilterFormHandler.
 */
class ProductFilterFormHandler implements FilterFormHandlerInterface
{
    use FilterFormHandlerTrait;

    private const MAX_PAGE = 10;

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
     *
     * @param ProductDTOFilterFactory $dtoFactory
     * @param ProductMapper           $productMapper
     * @param FormFactoryInterface    $factory
     * @param TokenStorageInterface   $tokenStorage
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(
        ProductDTOFilterFactory $dtoFactory,
        ProductMapper $productMapper,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->dtoFactory = $dtoFactory->newInstance();
        $this->productMapper = $productMapper;
        $this->form = $factory->createNamed(
            'kelp_product_filter',
            FilterProductType::class,
            $this->dtoFactory
        );
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     *
     * @return array
     *
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function process(Request $request): array
    {
        $filter = $this->dtoFactory;

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }

        $products = $this->productMapper->findAllByStorageAndByFilters(
            $request->get('id'),
            $filter,
            $request->get('page', 1),
            self::MAX_PAGE
        );

        $pagination = [
            'page' => $request->get('page', 1),
            'nbPages' => ceil(count($products) / self::MAX_PAGE),
            'nomRoute' => 'kelp.type_storage.list',
            'paramsRoute' => [],
        ];

        return [
            'pagination' => $pagination,
            'products' => $products,
        ];
    }
}
