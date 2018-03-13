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
     * TypeStorageFilterFormHandler constructor.
     * @param FormFactoryInterface $factory
     * @param StorageMapper        $mapper
     */
    public function __construct(FormFactoryInterface $factory, StorageMapper $mapper)
    {
        $this->form   = $factory->createNamed(
            'kelp_storage',
            StorageType::class,
            null
        );
        $this->mapper = $mapper;
    }

    /**
     * @param Request    $request
     * @param StorageDTO $storageDTO
     * @return bool
     */
    public function process(Request $request, StorageDTO $storageDTO = null): bool
    {
        $this->form->setData($storageDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $function = 'edit';

            if (!$storageDTO->id) {
                $storageDTO->typeStorage = $request->get('id');
                $function                = 'add';
            }
            $this->mapper->$function($storageDTO);

            return true;
        }

        return false;
    }
}
