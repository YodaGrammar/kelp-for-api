<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/03/2018
 * Time: 11:35
 */

namespace App\FilterFormHandler;

use App\DTOFilterFactory\PackagingDTOFilterFactory;
use App\Form\FilterPackagingType;
use App\Mapper\PackagingMapper;
use http\Env\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class PackagingFilterFormHandler
{
    use FilterFormHandlerTrait;

    private const MAX_PAGE = 10;

    /**
     * @var PackagingMapper
     */
    protected $mapper;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * @var PackagingDTOFilterFactory
     */
    protected $dtoFactory;

    /**
     * TypeStorageFilterFormHandler constructor.
     * @param FormFactoryInterface          $factory
     * @param PackagingDTOFilterFactory     $dtoFactory
     * @param PackagingMapper             $mapper
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $factory,
        PackagingDTOFilterFactory $dtoFactory,
        PackagingMapper $mapper,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->dtoFactory           = $dtoFactory->newInstance();
        $this->form                 = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterPackagingType::class,
            $this->dtoFactory
        );
        $this->mapper               = $mapper;
        $this->tokenStorage         = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @return array
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
        $packaging = $this->mapper->findAllByFilters($filter, $request->get('page', 1), self::MAX_PAGE);

        $pagination = [
            'page'        => $request->get('page', 1),
            'nbPages'     => ceil(count($packaging) / self::MAX_PAGE),
            'nomRoute'    => 'kelp.packaging.list',
            'paramsRoute' => [],
        ];

        return [
            'pagination'   => $pagination,
            'packaging' => $packaging,
        ];
    }
}
