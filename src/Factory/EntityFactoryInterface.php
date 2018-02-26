<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/02/2018
 * Time: 14:22
 */

namespace App\Factory;

interface EntityFactoryInterface
{
    public function newInstance($data, $id = null);
}
