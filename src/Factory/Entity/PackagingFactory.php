<?php

namespace App\Factory\Entity;

use App\Entity\Packaging;
use Doctrine\Common\Persistence\ManagerRegistry;
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
     */
    public function create($dto): Packaging
    {
        $packaging = new Packaging();
        $packaging->setLabel($dto->label);

        return $packaging;
    }
}
