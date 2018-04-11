<?php

namespace App\Factory\Entity;

use App\Entity\Product;
use App\Entity\Storage;
use App\Exception\NotFoundException;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class ProductFactory implements EntityFactoryInterface
{
    /** @var ManagerRegistry */
    protected $managerRegistry;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * StorageFactory constructor.
     * @param ManagerRegistry $managerRegistry
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ManagerRegistry $managerRegistry, TokenStorageInterface $tokenStorage)
    {
        $this->managerRegistry = $managerRegistry;
        $this->tokenStorage    = $tokenStorage;
    }

    /**
     * @param $dto
     * @return Product
     * @throws NotFoundException
     */
    public function newInstance($dto): Product
    {
        $product = new Product();
        $product->setLabel($dto->label);

        $storage = $this->managerRegistry->getRepository(Storage::class)->find($dto->storage);
        if (!$storage) {
            throw new NotFoundException('this storage does not exist');
        }
        $product->setStorage($storage);
        $product->setQuantity($dto->quantity);
        $product->setPackaging($dto->packaging);
        if ($dto->date) {
            $product->setDatePeremption($dto->date);
        }
        $product->setDateAdd(new \DateTime());
        $product->setActive(true);
        $this->managerRegistry->getManager()->persist($product);
        $this->managerRegistry->getManager()->flush();

        return $product;
    }
}
