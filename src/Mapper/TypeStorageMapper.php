<?php

namespace App\Mapper;

use App\DTO\FilterTypeStorageDTO;
use App\DTO\TypeStorageDTO;
use App\Entity\Repository\TypeStorageRepository;
use App\Entity\TypeStorage;
use App\Factory\TypeStorageFactory;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TypeStorageDoctrineMapper
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
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param FilterTypeStorageDTO|null $typeStorageDTO
     */
    public function findAllByFilters(FilterTypeStorageDTO $typeStorageDTO = null, $page)
    {
        return $this->getRepository()->findBySearch($typeStorageDTO->text);
    }

    /**
     * @param TypeStorageDTO $dto
     */
    public function add(TypeStorageDTO $dto)
    {
        $typeStorage = $this->typeStorageFactory->newInstance($dto);
        $this->objectManager->persist($typeStorage);
        $this->objectManager->flush($typeStorage);
    }

    /**
     * @param string $idTypeStorage
     * @return TypeStorage
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
