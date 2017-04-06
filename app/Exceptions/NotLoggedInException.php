<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 16/10/2015
 * Time: 08:53
 */

namespace App\Exceptions;

/*
 * When an operation needs a logged in user
 */
class NotLoggedInException extends \RuntimeException
{
    /**
     * Constructor.
     *
     * @param string $message The internal exception message
     * @param \Exception $previous The previous exception
     * @param int $code The internal exception code
     */
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct($message, $code, $previous);
    }
}