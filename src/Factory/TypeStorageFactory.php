<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 22/02/2018
 * Time: 13:06
 */

namespace App\Factory;


use App\Entity\TypeStorage;

class TypeStorageFactory
{
    /**
     * @return TypeStorage
     */
    public function newInstance():TypeStorage
    {
        return new TypeStorage();
    }
}