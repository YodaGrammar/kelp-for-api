<?php
/**
 * Created by PhpStorm.
 * User: groot
 * Date: 22/04/2017
 * Time: 10:04.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TypeProduct.
 *
 * @ORM\Entity
 * @ORM\Table(name="kelp_type_product")
 */
class TypeProduct
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
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    private $unit;

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
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit(string $unit)
    {
        $this->unit = $unit;
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
