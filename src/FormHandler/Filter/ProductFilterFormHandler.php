<?php

namespace App\FormHandler\Filter;

use App\Form\Filter\FilterProductType;
use App\Repository\ProductRepository;
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
     * @var ProductRepository
     */
    protected $repository;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * ProductFilterFormHandler constructor.
     *
     * @param ProductRepository     $repository
     * @param FormFactoryInterface  $factory
     * @param TokenStorageInterface $tokenStorage
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(
        ProductRepository $repository,
        FormFactoryInterface $factory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->repository = $repository;
        $this->form = $factory->createNamed(
            'kelp_product_filter',
            FilterProductType::class
        );
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     *
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \Symfony\Component\Form\Exception\LogicException
     *
     * @return array
     */
    public function process(Request $request): array
    {
        $filter = null;

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }

        $products = $this->repository->findAllByStorageAndByFilters(
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
