<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 14/03/2018
 * Time: 10:13
 */

namespace App\Factory;

use App\DTO\ProductDTO;
use App\Entity\Product;
use App\Entity\Storage;
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
        $product->setLabel($dto->label);

        $storage = $this->objectManager->getRepository(Storage::class)->find($dto->storage);
        if (!$storage) {
            throw new NotFoundException('this storage does not exist');
        }
        $product->setStorage($storage);
        $product->setQuantity($dto->quantity);
        $product->setPackaging($dto->packaging);
        if ($dto->date) {
            $product->setDate($dto->date);
        }
        $product->setActive(true);
        $this->objectManager->persist($product);
        $this->objectManager->flush();

        return $product;
    }
}
