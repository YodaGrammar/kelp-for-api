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

    /**
     * @var TypeStorageMapper
     */
    protected $typeStorageMapper;

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
     * @param FormFactoryInterface $factory
     * @param FilterTypeStorageDTOFactory $dtoFactory
     * @param TypeStorageMapper $typeStorageMapper
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $factory,
        FilterTypeStorageDTOFactory $dtoFactory,
        TypeStorageMapper $typeStorageMapper,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->dtoFactory = $dtoFactory->newInstance();
        $this->form                        = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class,
            $this->dtoFactory
        );
        $this->typeStorageMapper           = $typeStorageMapper;
        $this->tokenStorage                = $tokenStorage;
        $this->authorizationChecker        = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function process(Request $request)
    {
        $filter = $this->filterTypeStorageDTOFactory;

        if (false === $this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN')) {
            $filter->setUser($this->tokenStorage->getToken()->getUser());
        }

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }

        return $this->typeStorageMapper->findAllByFilters($filter, $request->get('page', 1));
    }
}
