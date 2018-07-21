<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="kelp_product")
 */
class Product
{
    use EntityTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Packaging", inversedBy="products")
     * @ORM\JoinColumn(name="packaging_id", referencedColumnName="id", nullable=false)
     */
    private $packaging;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="Storage", inversedBy="products")
     * @ORM\JoinColumn(name="storage_id", referencedColumnName="id", nullable=false)
     **/
    private $storage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $datePeremption = null;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $dateAdd;

    public function __construct()
    {
        $this->dateAdd = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPackaging()
    {
        return $this->packaging;
    }

    /**
     * @param mixed $packaging
     */
    public function setPackaging($packaging): void
    {
        $this->packaging = $packaging;
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
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param mixed $storage
     */
    public function setStorage($storage): void
    {
        $this->storage = $storage;
    }

    /**
     * @return \DateTime
     */
    public function getDatePeremption(): ?\DateTime
    {
        return $this->datePeremption;
    }

    /**
     * @param  $datePeremption
     */
    public function setDatePeremption($datePeremption): void
    {
        $this->datePeremption = $datePeremption;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdd(): \DateTime
    {
        return $this->dateAdd;
    }

    /**
     * @param \DateTime $dateAdd
     */
    public function setDateAdd(\DateTime $dateAdd): void
    {
        $this->dateAdd = $dateAdd;
    }
}
