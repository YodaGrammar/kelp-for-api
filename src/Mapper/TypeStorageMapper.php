<?php

namespace App\Mapper;

use App\DTO\FilterTypeStorageDTO;
use App\DTO\TypeStorageDTO;
use App\Entity\Repository\TypeStorageRepository;
use App\Entity\TypeStorage;
use App\Factory\TypeStorageFactory;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TypeStorageMapper
 *
 * @package Kelp\AppBundle\Mapper
 */
class TypeStorageMapper
{

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var TypeStorageFactory
     */
    protected $typeStorageFactory;

    /**
     * TypeStorageMapper constructor.
     * @param ObjectManager $objectManager
     * @param TypeStorageFactory $typeStorageFactory
     */
    public function __construct(ObjectManager $objectManager, TypeStorageFactory $typeStorageFactory)
    {
        $this->objectManager      = $objectManager;
        $this->typeStorageFactory = $typeStorageFactory;
    }

    /**
     * @return TypeStorageRepository
     */
    protected function getRepository(): TypeStorageRepository
    {
        return $this->objectManager->getRepository(TypeStorage::class);
    }

    /**
     * @return array
     */
    public function findAll():array
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param FilterTypeStorageDTO|null $typeStorageDTO
     * @param null $page
     * @param null $maxPage
     * @return mixed
     */
    public function findAllByFilters(FilterTypeStorageDTO $typeStorageDTO = null, $page = null, $maxPage = null)
    {
        return $this->getRepository()->findAllByFilters($typeStorageDTO->text, $page, $maxPage);
    }

    /**
     * @param TypeStorageDTO $dto
     */
    public function add(TypeStorageDTO $dto)
    {
        $typeStorage = $this->typeStorageFactory->newInstance($dto);
        $this->objectManager->persist($typeStorage);
        $this->objectManager->flush();
    }

    /**
     * @param string $idTypeStorage
     * @return TypeStorage|null|object
     * @throws \LogicException
     */
    public function find(string $idTypeStorage)
    {
        /** @var TypeStorage $typeStorage */
        $typeStorage = $this->getRepository()->find($idTypeStorage);
        if (!$typeStorage) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $idTypeStorage));
        }

        return $typeStorage;
    }

    /**
     * @param string $idTypeStorage
     * @param TypeStorageDTO $dto
     * @throws \LogicException
     */
    public function edit(string $idTypeStorage, TypeStorageDTO $dto)
    {
        /** @var TypeStorage $typeStorage */
        $typeStorage = $this->getRepository()->find($idTypeStorage);
        if (!$typeStorage) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $idTypeStorage));
        }
        $typeStorage->setLabel($dto->label);
        $typeStorage->setComment($dto->comment);
        $typeStorage->setClass($dto->class);
        $this->objectManager()->flush($typeStorage);
    }

    /**
     * @param $id
     * @throws \LogicException
     */
    public function delete($id)
    {
        /** @var TypeStorage $typeStorage */
        $typeStorage = $this->getRepository()->find($id);
        if (!$typeStorage) {
            throw new \LogicException(sprintf('impossible to find information for id %s', $id));
        }
        $typeStorage->setActive(false);
        $this->getManager()->flush($typeStorage);
    }
}
