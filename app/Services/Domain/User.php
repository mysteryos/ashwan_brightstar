<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 21/01/2016
 * Time: 15:00
 */

namespace App\Services\Domain;

use Carbon\Carbon;
use App\Models\UserIntro;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Sentinel;
use Crypt;

class User extends BaseDomain
{
    public function licenseAgreement()
    {
        $this->data['pageTitle'] = 'License Agreement';

        return $this->data;
    }
}