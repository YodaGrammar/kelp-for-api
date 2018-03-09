<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 15/02/2018
 * Time: 13:29
 */

namespace App\FormHandler;

use App\DTO\StorageDTO;
use App\DTOFactory\StorageDTOFactory;
use App\Form\StorageType;
use App\Mapper\StorageMapper;
use App\Mapper\TypeStorageMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class StorageFormHandler
 * @package App\FormHandler
 */
class StorageFormHandler
{
    use FormHandlerTrait;

    /**
     * @var TypeStorageMapper
     */
    protected $mapper;


    /**
     * @var StorageDTOFactory
     */
    protected $dto;

    /**
     * TypeStorageFilterFormHandler constructor.
     * @param FormFactoryInterface $factory
     * @param StorageDTOFactory    $dtoFactory
     * @param StorageMapper        $mapper
     */
    public function __construct(
        FormFactoryInterface $factory,
        StorageDTOFactory $dtoFactory,
        StorageMapper $mapper
    ) {
        $this->dto    = $dtoFactory->newInstance();
        $this->form   = $factory->createNamed(
            'kelp_type_storage_filter',
            StorageType::class,
            $this->dto
        );
        $this->mapper = $mapper;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function process(Request $request)
    {
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';
            if (!$this->dto->getId()) {
                $this->dto->setTypeStorage($request->get('id'));
                $function = 'add';
            }
            $this->mapper->$function($this->dto);

            return true;
        }

        return false;
    }
}
