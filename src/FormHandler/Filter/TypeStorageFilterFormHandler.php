<?php

namespace App\FormHandler\Filter;

use App\Form\Filter\FilterTypeStorageType;
use App\Repository\TypeStorageRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class TypeStorageFilterFormHandler
 *
 * @package App\FormHandler\Filter
 */
class TypeStorageFilterFormHandler implements FilterFormHandlerInterface
{
    use FilterFormHandlerTrait;

    private const MAX_PAGE = 10;

    /**
     * @var TypeStorageRepository
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
     * TypeStorageFilterFormHandler constructor.
     *
     * @param FormFactoryInterface          $factory
     * @param TypeStorageRepository         $repository
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function __construct(
        FormFactoryInterface $factory,
        TypeStorageRepository $repository,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    )
    {
        $this->form                 = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class
        );
        $this->repository           = $repository;
        $this->tokenStorage         = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
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
        $filter = null;

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }
        $typeStorages = $this->repository->findAllByFilters($filter, $request->get('page', 1), self::MAX_PAGE);

        $pagination = [
            'page'        => $request->get('page', 1),
            'nbPages'     => ceil(count($typeStorages) / self::MAX_PAGE),
            'nomRoute'    => 'kelp.type_storage.list',
            'paramsRoute' => [],
        ];

        return [
            'pagination'   => $pagination,
            'typeStorages' => $typeStorages,
        ];
    }
}
