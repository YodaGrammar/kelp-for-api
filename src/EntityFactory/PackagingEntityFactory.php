<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:33
 */

namespace App\EntityFactory;

use App\Entity\Packaging;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class PackagingEntityFactory
 * @package App\Factory
 */
class PackagingEntityFactory implements EntityFactoryInterface
{
    /** @var ObjectManager */
    protected $objectManager;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * StorageFactory constructor.
     * @param ObjectManager         $objectManager
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ObjectManager $objectManager, TokenStorageInterface $tokenStorage)
    {
        $this->objectManager = $objectManager;
        $this->tokenStorage  = $tokenStorage;
    }

    public function newInstance($dto):Packaging
    {
        // TODO: Implement process() method.
    }
}
