<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 20/01/2016
 * Time: 14:08
 */

namespace App\Services\Domain;

use Carbon\Carbon;
use Sentinel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
class Dashboard extends BaseDomain
{
    private $activeJob;
    private $department;

    /**
     * GET: Index
     *
     * @param \App\Models\User $user
     * @return array
     */
    public function getIndex(\App\Models\User $user)
    {

        $this->data['pageTitle'] = 'Dashboard';

        return $this->data;
    }
}