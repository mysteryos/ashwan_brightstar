<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 15/10/2015
 * Time: 13:37
 */

namespace App\Services;

use App\Exceptions\HttpExceptionWithError;
use Symfony\Component\HttpFoundation\Response;

class Service
{
    protected $repository;
    protected $service;
    protected $request;
    //Current user for service
    public $user;

    /*
     * Class Construct
     * @param mixed $repository
     * @param mixed $request
     */
    public function __construct() {
        $this->service = new DependencyResolver('service');
        $this->repository = new DependencyResolver('repository');
    }

    protected function validate(array $data, $rules) {
        $validator = app('Illuminate\Contracts\Validation\Factory')->make($data,$rules);
        if(!$validator->passes())
        {
            throw new HttpExceptionWithError(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
    }
}