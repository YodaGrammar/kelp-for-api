<?php

namespace App\Factory;

use App\Entity\Storage;
use App\Entity\TypeStorage;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StorageFactory
 * @package App\Factory
 */
class StorageFactory implements EntityFactoryInterface
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
     * @return Storage
     */
    public function newInstance($data, $id = null): Storage
    {
        $storage = new Storage();

        return $storage;
    }
}
