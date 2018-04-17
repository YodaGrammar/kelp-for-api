<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 11/04/2018
 * Time: 13:16.
 */

namespace App\Factory;

use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginatorFactory implements PaginatorFactoryInterface
{
    public function newInstance($query)
    {
        return new Paginator($query);
    }
}
