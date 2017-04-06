<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 13/11/2015
 * Time: 15:39
 */

namespace App\Repositories;

use Sentinel;
use DB;
class Role extends Repository
{
    public function __construct()
    {
        parent::__construct(Sentinel::getRoleRepository());
    }

    /**
     * Check if user has role
     *
     * @param int $role_id
     * @param int $user_id
     * @return bool
     */
    public function checkUserHasRole($role_id,$user_id) {
        return (boolean) DB::table('role_users')->where('role_id','=',$role_id)
                        ->where('user_id','=',$user_id,'AND')
                        ->count();
    }

    /**
     * Get Super Admin Slug
     *
     * @return string
     */
    public function getSuperAdminSlug()
    {
        return 'superadmin';
    }
}