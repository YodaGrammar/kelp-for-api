<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/02/2018
 * Time: 13:06
 */

namespace App\Factory;

use App\Entity\TypeStorage;
use Doctrine\Common\Persistence\ObjectManager;

class TypeStorageFactory implements EntityFactoryInterface
{
    /** @var ObjectManager */
    protected $objectManager;

    /**
     * AbstractEntityFactory constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param array $data
     * @param null $id
     * @return TypeStorage
     */
    public function newInstance($data, $id = null):TypeStorage
    {
        $typeStorage = new TypeStorage();
        $typeStorage->setLabel();
        $typeStorage->setClass();

        return $typeStorage;
    }
}