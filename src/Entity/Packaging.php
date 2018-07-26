<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PackagingRepository")
 * @ORM\Table(name="kelp_packaging")
 */
class Packaging
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
     * @ORM\OneToMany(targetEntity="Product", mappedBy="packaging")
     **/
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
     * @return iterable
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param iterable $products
     *
     * @return self
     */
    public function setProduct(iterable $products): self
    {
        $this->products = $products;

        return $this;
    }
}
