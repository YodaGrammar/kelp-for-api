<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:34.
 */

namespace App\Factory\Entity;

interface EntityFactoryInterface
{
    public function newInstance($dto);
}
