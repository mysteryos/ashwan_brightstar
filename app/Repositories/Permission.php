<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 06/11/2015
 * Time: 16:07
 */

namespace App\Repositories;


class Permission extends Repository
{
    public function __construct(\App\Models\Permissions $permission)
    {
        parent::__construct($permission);
    }

    /**
     * Get all Records
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model
                ->newQuery()
                ->orderBy('name','ASC')
                ->get();
    }

    /**
     * Validation Rules - Add
     *
     * @return array
     */
    public function getAddPermissionValidationRules()
    {
        return [
            'permission_slug' => 'required|max:255|exists:permissions,slug',
            'permission_value' => 'required|boolean'
        ];
    }

    /**
     * Superadmin - Slug
     *
     * @return string
     */
    public function getSuperAdminSlug()
    {
        return "superadmin";
    }

    /**
     * Human Resources - Slug
     *
     * @return string
     */
    public function getHumanResourcesSlug()
    {
        return "human-resources";
    }
}