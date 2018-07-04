<?php

namespace App\FormHandler\Filter;

use App\Form\Filter\FilterPackagingType;
use App\Repository\PackagingRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class PackagingFilterFormHandler
{
    use FilterFormHandlerTrait;

    private const MAX_PAGE = 10;

    /**
     * @var PackagingRepository
     */
    protected $repository;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * PackagingFilterFormHandler constructor.
     *
     * @param FormFactoryInterface          $factory
     * @param PackagingRepository           $repository
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(
        FormFactoryInterface $factory,
        PackagingRepository $repository,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->form = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterPackagingType::class
        );
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     *
     * @throws \Symfony\Component\Form\Exception\LogicException
     *
     * @return array
     */
    public function process(Request $request): array
    {
        $filter = null;
        $this->form->handleRequest($request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }
        $packaging = $this->repository->findAllByFilters($filter, $request->get('page', 1), self::MAX_PAGE);

        $pagination = [
            'page' => $request->get('page', 1),
            'nbPages' => ceil(count($packaging) / self::MAX_PAGE),
            'nomRoute' => 'kelp.packaging.list',
            'paramsRoute' => [],
        ];

        return [
            'pagination' => $pagination,
            'packagings' => $packaging,
        ];
    }
}
