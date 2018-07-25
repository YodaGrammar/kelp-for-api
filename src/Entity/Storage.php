<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StorageRepository")
 * @ORM\Table(name="kelp_storage")
 */
class Storage
{
    use EntityTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="storages")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     **/
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="TypeStorage")
     * @ORM\JoinColumn(name="type_storage_id", referencedColumnName="id", nullable=false)
     **/
    private $typeStorage;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="storage")
     */
    private $products;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
    }

    /**
     * @return TypeStorage
     */
    public function getTypeStorage(): TypeStorage
    {
        return $this->typeStorage;
    }

    /**
     * @param TypeStorage $typeStorage
     *
     * @return self
     */
    public function setTypeStorage($typeStorage): self
    {
        $this->typeStorage = $typeStorage;

        return $this;
    }

    /**
     * @return iterable|null
     */
    public function getProducts(): ?iterable
    {
        return $this->products;
    }

    /**
     * @param ?iterable $products
     *
     * @return self
     */
    public function setProducts(?iterable $products): self
    {
        $this->products = $products;

        return $this;
    }
}
