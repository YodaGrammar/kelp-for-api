<?php

namespace App\FormHandler;

use App\DTO\PackagingDTO;
use App\Factory\Entity\PackagingFactory;
use App\Form\PackagingType;
use App\Repository\PackagingRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StorageFormHandler.
 */
class PackagingFormHandler implements FormHandlerInterface
{
    use FormHandlerTrait;

    /**
     * @var PackagingRepository
     */
    protected $repository;

    /**
     * @var PackagingFactory
     */
    protected $factory;

    /**
     * PackagingFormHandler constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param PackagingRepository  $repository
     * @param PackagingFactory     $factory
     */
    public function __construct(FormFactoryInterface $formFactory, PackagingRepository $repository, PackagingFactory $factory)
    {
        $this->form       = $formFactory->createNamed(
            'kelp_packaging',
            PackagingType::class,
            null
        );
        $this->repository = $repository;
        $this->factory    = $factory;
    }

    /**
     * @param Request           $request
     * @param PackagingDTO|null $packagingDTO
     *
     * @return bool
     */
    public function process(Request $request, PackagingDTO $packagingDTO = null): bool
    {
        $this->form->setData($packagingDTO);
        $this->form->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            $function = 'edit';

            if (!$packagingDTO->id) {
                $function = 'add';
            }
            return $this->$function($packagingDTO);
        }
        return false;
    }

    public function add($dto)
    {
        $packaging = $this->factory->newInstance($dto);

        if($packaging) {
            return true;
        }
        return false;
    }

    public function edit($dto)
    {
        $packaging = $this->repository->edit($dto);

        if($packaging) {
            return true;
        }
        return false;
    }
}
