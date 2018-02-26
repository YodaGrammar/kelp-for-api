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
     * TypeStorageFilterFormHandler constructor.
     * @param FormFactoryInterface $factory
     * @param FilterTypeStorageDTOFactory $filterTypeStorageDTOFactory
     * @param TypeStorageMapper $typeStorageMapper
     */
    public function __construct(FormFactoryInterface $factory,
                                FilterTypeStorageDTOFactory $filterTypeStorageDTOFactory,
                                TypeStorageMapper $typeStorageMapper
//                                TokenStorageInterface $tokenStorage,
//                                AuthorizationCheckerInterface $authorizationChecker
    )
    {

        $this->filterTypeStorageDTOFactory = $filterTypeStorageDTOFactory->newInstance();
        $this->form                        = $factory->createNamed(
            'kelp_type_storage_filter',
            FilterTypeStorageType::class,
            $this->filterTypeStorageDTOFactory
        );
        $this->typeStorageMapper           = $typeStorageMapper;
//        $this->tokenStorage                = $tokenStorage;
//        $this->authorizationChecker        = $authorizationChecker;
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
        dump($this->typeStorageMapper->findAll());die;
        $filter = $this->filterTypeStorageDTOFactory;

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