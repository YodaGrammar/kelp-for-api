<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 24/04/2018
 * Time: 14:20
 */

namespace App\Entity;


trait EntityTrait
{
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $active = 1;

    /**
     * @return bool
     */
    public function isActive():bool
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}