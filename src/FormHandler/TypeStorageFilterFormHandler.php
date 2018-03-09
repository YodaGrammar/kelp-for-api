<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 15/02/2018
 * Time: 13:26
 */

namespace App\FormHandler;

use App\DTOFactory\FilterTypeStorageDTOFactory;
use App\Form\FilterTypeStorageType;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class TypeStorageFilterFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    private const MAX_PAGE = 10;

    /**
     * @var TypeStorageMapper
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
     * @var FilterTypeStorageDTOFactory
     */
    protected $dtoFactory;

    /**
     * TypeStorageFilterFormHandler constructor.
     * @param FormFactoryInterface          $factory
     * @param FilterTypeStorageDTOFactory   $dtoFactory
     * @param TypeStorageMapper             $mapper
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $factory,
        FilterTypeStorageDTOFactory $dtoFactory,
        TypeStorageMapper $mapper,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->dtoFactory           = $dtoFactory->newInstance();
        $this->form                 = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class,
            $this->dtoFactory
        );
        $this->mapper               = $mapper;
        $this->tokenStorage         = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
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
        $typeStorages = $this->mapper->findAllByFilters($filter, $request->get('page', 1), self::MAX_PAGE);

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
