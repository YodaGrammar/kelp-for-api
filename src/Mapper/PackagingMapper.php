<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:32
 */

namespace App\Mapper;

class PackagingMapper
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var PackagingFactory
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
}
