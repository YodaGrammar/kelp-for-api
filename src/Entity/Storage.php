<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StorageRepository")
 * @ORM\Table(name="kelp_storage")
 */
class Storage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
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
     * @ORM\Column(type="boolean")
     * @var boolean
     **/
    private $active;

    /**
     * @return mixed
     */
    public function getId()
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
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTypeStorage()
    {
        return $this->typeStorage;
    }

    /**
     * @param mixed $typeStorage
     */
    public function setTypeStorage($typeStorage)
    {
        $this->typeStorage = $typeStorage;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }
}
