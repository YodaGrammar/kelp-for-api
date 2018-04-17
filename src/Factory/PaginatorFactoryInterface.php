<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 11/04/2018
 * Time: 13:17.
 */

namespace App\Factory;

interface PaginatorFactoryInterface
{
    public function newInstance($query);
}
