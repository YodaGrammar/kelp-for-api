<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Packaging
 * @package App\Entity
 * @ORM\Entity
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
     * @var string
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="packaging")
     * @ORM\JoinColumn(name="packaging_id", referencedColumnName="id")
     */
    private $product;
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
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }
}
