<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 16/11/2015
 * Time: 14:49
 */

namespace App\Services\Domain;

use Sentinel;
use App\Services\DependencyResolver;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\HttpExceptionWithError;
use Illuminate\Foundation\Bus\DispatchesJobs;
class BaseDomain
{

    use DispatchesJobs;

    protected $data;
    protected $service;
    protected $repository;
    protected $isSuperAdmin = false;
    protected $user;

    public function __construct()
    {
        $this->service = new DependencyResolver('service');
        $this->repository = new DependencyResolver('repository');
        $this->user = Sentinel::check();
        $this->isSuperAdmin = app('\App\Services\Permission')->isSuperAdmin($this->user);
    }

    /**
     * Validates data through Laravel's Validator
     *
     * @param array $data
     * @param array $rules
     * @throws HttpExceptionWithError
     */
    protected function validateData(array $data, array $rules)
    {
        $validator = app('Illuminate\Contracts\Validation\Factory')->make($data,$rules);
        if(!$validator->passes())
        {
            throw new HttpExceptionWithError(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
    }
}