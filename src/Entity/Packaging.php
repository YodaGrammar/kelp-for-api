<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PackagingRepository")
 * @ORM\Table(name="kelp_packaging")
 */
class Packaging
{
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
     * @ORM\OneToMany(targetEntity="Product", mappedBy="packaging")
     **/
    private $products;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = 1;

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
    public function setLabel(string $label): void
    {
        $this->label = $label;
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
    public function setProduct($products): void
    {
        $this->products = $products;
    }

    /**
     * @return bool
     */
    public function isEnabled():bool
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
