<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/02/2018
 * Time: 13:06
 */

namespace App\EntityFactory;

use Doctrine\Common\Persistence\ObjectManager;

class TypeStorageEntityFactory implements EntityFactoryInterface
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

    public function newInstance($dto)
    {
        // TODO: Implement newInstance() method.
    }

//    /**
//     * @param array $data
//     * @param null $id
//     * @return TypeStorage
//     */
//    public function newInstance($data, $id = null):TypeStorage
//    {
//        $typeStorage = new TypeStorage();
//        $typeStorage->setLabel();
//        $typeStorage->setClass();
//
//        return $typeStorage;
//    }
}
