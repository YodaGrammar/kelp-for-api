<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:32
 */

namespace App\Mapper;

use App\Factory\PackagingFactory;
use Doctrine\Common\Persistence\ObjectManager;

class PackagingMapper
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var PackagingFactory
     */
    protected $packagingFactory;

    /**
     * PackagingMapper constructor.
     * @param ObjectManager    $objectManager
     * @param PackagingFactory $packagingFactory
     */
    public function __construct(ObjectManager $objectManager, PackagingFactory $packagingFactory)
    {
        $this->objectManager      = $objectManager;
        $this->packagingFactory = $packagingFactory;
    }
}
