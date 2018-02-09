<?php
/**
 * Created by PhpStorm.
 * User: groot
 * Date: 02/04/2017
 * Time: 00:24
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TypeStorage
 *
 * @ORM\Entity(repositoryClass="App\Entity\Repository\TypeStorageRepository")
 * @ORM\Table(name="kelp_type_storage")
 *
 * @package APP\Entity
 */
class TypeStorage
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
     * @ORM\Column(type="text")
     * @var string
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $class;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $active = true;

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
    public function getLabel():string
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
     * @return string
     */
    public function getComment():string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return bool
     */
    public function isActive():bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }
}
