<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 20/10/2015
 * Time: 08:49
 */

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
class HttpExceptionWithError extends HttpException
{

    private $statusCode;
    private $headers;
    private $errors;

    public function __construct($statusCode, $errors = array(), $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->errors = $errors;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}