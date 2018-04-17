<?php

namespace App\Factory\Entity;

use App\Entity\Packaging;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class PackagingEntityFactory.
 */
class PackagingFactory implements EntityFactoryInterface
{
    /** @var ManagerRegistry */
    protected $managerRegistry;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * PackagingFactory constructor.
     *
     * @param ManagerRegistry       $managerRegistry
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ManagerRegistry $managerRegistry, TokenStorageInterface $tokenStorage)
    {
        $this->managerRegistry = $managerRegistry;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param $dto
     *
     * @return Packaging
     *
     * @throws \InvalidArgumentException
     */
    public function newInstance($dto): Packaging
    {
        $packaging = new Packaging();
        $packaging->setLabel($dto->label);

        $this->managerRegistry->getManager()->persist($packaging);
        $this->managerRegistry->getManager()->flush();

        return $packaging;
    }
}
