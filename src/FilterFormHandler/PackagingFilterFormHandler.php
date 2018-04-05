<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/03/2018
 * Time: 11:35
 */

namespace App\FilterFormHandler;

use App\DTOFilterFactory\PackagingDTOFilterFactory;
use App\FilterForm\FilterPackagingType;
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
     * @var PackagingDTOFilterFactory
     */
    protected $dtoFactory;

    /**
     * PackagingFilterFormHandler constructor.
     * @param FormFactoryInterface          $factory
     * @param PackagingDTOFilterFactory     $dtoFactory
     * @param PackagingRepository           $repository
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $factory,
        PackagingDTOFilterFactory $dtoFactory,
        PackagingRepository $repository,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->dtoFactory           = $dtoFactory->newInstance();
        $this->form                 = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterPackagingType::class,
            $this->dtoFactory
        );
        $this->repository           = $repository;
        $this->tokenStorage         = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function process(Request $request): array
    {
        $filter = $this->dtoFactory;

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }
        $packaging = $this->repository->findAllByFilters($filter, $request->get('page', 1), self::MAX_PAGE);

        $pagination = [
            'page'        => $request->get('page', 1),
            'nbPages'     => ceil(count($packaging) / self::MAX_PAGE),
            'nomRoute'    => 'kelp.packaging.list',
            'paramsRoute' => [],
        ];

        return [
            'pagination' => $pagination,
            'packagings'  => $packaging,
        ];
    }
}
