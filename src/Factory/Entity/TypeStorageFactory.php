<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/02/2018
 * Time: 13:06.
 */

namespace App\Factory\Entity;

use App\Entity\TypeStorage;
use Doctrine\Common\Persistence\ManagerRegistry;

class TypeStorageFactory implements EntityFactoryInterface
{
    /** @var ManagerRegistry */
    protected $managerRegistry;

    /**
    /**
     * StorageFactory constructor.
     *
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param $dto
     *
     * @return TypeStorage
     *
     * @throws \InvalidArgumentException
     */
    public function newInstance($dto): TypeStorage
    {
        $typeStorage = new TypeStorage();
        $typeStorage->setLabel($dto->label);
        $typeStorage->setClass($dto->class);
        $typeStorage->setComment($dto->comment);

        $this->managerRegistry->getManager()->persist($typeStorage);
        $this->managerRegistry->getManager()->flush();

        return $typeStorage;
    }
}
