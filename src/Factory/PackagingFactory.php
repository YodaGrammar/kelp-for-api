<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:33
 */

namespace App\Factory;

use App\Entity\Packaging;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class PackagingFactory
 * @package App\Factory
 */
class PackagingFactory implements FactoryInterface
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
