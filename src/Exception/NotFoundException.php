<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 09/03/2018
 * Time: 11:31.
 */

namespace App\Exception;

use Throwable;

/**
 * Class NotFoundException.
 */
class NotFoundException extends \Exception
{
    /**
     * FactoryException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }
}
