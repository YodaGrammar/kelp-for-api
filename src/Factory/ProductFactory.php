<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 14/03/2018
 * Time: 10:13
 */

namespace App\Factory;


use App\Entity\Product;
use App\Exception\NotFoundException;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class ProductFactory
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

    /**
     * @param ProductDTO $dto
     * @return Product
     * @throws NotFoundException
     */
    public function newInstance(ProductDTO $dto): Product
    {
        $product = new Product();
//        $product->setLabel($dto->label);
//        $product->setUser($this->tokenStorage->getToken()->getUser());
//        $typeStorage = $this->objectManager->getRepository(TypeStorage::class)->find($dto->typeStorage);
//        if (!$typeStorage) {
//            throw new NotFoundException('this type storage does not exist');
//        }
//        $product->setTypeStorage($typeStorage);
//        $this->objectManager->persist($storage);
//        $this->objectManager->flush();

        return $product;
    }
}