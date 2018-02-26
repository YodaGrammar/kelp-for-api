<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 15/02/2018
 * Time: 13:26
 */

namespace App\FormHandler;


use App\DTO\FilterTypeStorageDTO;
use App\DTOFactory\FilterTypeStorageDTOFactory;
use App\Form\FilterTypeStorageType;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class TypeStorageFilterFormHandler
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
    protected $filterTypeStorageDTOFactory;

    /**
     * @param FormFactoryInterface $factory
     * @param TypeStorageMapper $typeStorageMapper
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(FormFactoryInterface $factory,
                                TypeStorageMapper $typeStorageMapper,
//                                TokenStorageInterface $tokenStorage,
//                                AuthorizationCheckerInterface $authorizationChecker,
                                FilterTypeStorageDTOFactory $filterTypeStorageDTOFactory
    )
    {
        $this->form                        = $factory->createNamed('kelp_type_storage_filter', FilterTypeStorageType::class);
        $this->typeStorageMapper           = $typeStorageMapper;
//        $this->tokenStorage                = $tokenStorage;
//        $this->authorizationChecker        = $authorizationChecker;
        $this->filterTypeStorageDTOFactory = $filterTypeStorageDTOFactory;
    }

    /**
     * Process.
     *
     * @param Request $request
     *
     * @return Pagerfanta
     */
    public function process(Request $request)
    {
        $filter = $this->filterTypeStorageDTOFactory->newInstance();

//        if (false === $this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN')) {
//            $filter->setUser($this->tokenStorage->getToken()->getUser());
//        }

        $this->form->setData($filter);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $filter = $this->form->getData();
        }

        return $this->typeStorageMapper->findAllByFilters($filter, $request->get('page', 1));
    }

}