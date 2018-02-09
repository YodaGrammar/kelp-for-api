<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="kelp_product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="TypeProduct")
     * @ORM\JoinColumn(name="type_product_id", referencedColumnName="id")
     **/
    private $typeProduct;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getTypeProduct()
    {
        return $this->typeProduct;
    }

    /**
     * @param mixed $typeProduct
     */
    public function setTypeProduct($typeProduct)
    {
        $this->typeProduct = $typeProduct;
    }
}
