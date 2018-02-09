<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="kelp_user")
 * @ORM\Entity(repositoryClass="App\Entity\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Many User have Many Type Storage.
     * @ORM\ManyToMany(targetEntity="TypeStorage")
     * @ORM\JoinTable(name="kelp_user_type_storage",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="type_storage_id", referencedColumnName="id")}
     *      )
     */
    protected $typeStorages;

    /**
     * @ORM\OneToMany(targetEntity="Storage", mappedBy="user")
     **/
    protected $storages;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->typeStorages = new ArrayCollection();
        $this->storages     = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTypeStorages()
    {
        return $this->typeStorages;
    }

    /**
     * @param mixed $typeStorages
     */
    public function setTypeStorages($typeStorages)
    {
        $this->typeStorages = $typeStorages;
    }

    /**
     * @return mixed
     */
    public function getStorages()
    {
        return $this->storages;
    }

    /**
     * @param mixed $storages
     */
    public function setStorages($storages)
    {
        $this->storages = $storages;
    }
}
