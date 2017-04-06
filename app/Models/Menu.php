<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 22/10/2015
 * Time: 07:56
 */

namespace App\Models;

use Sentinel;
use Request;

class Menu
{
    public $name;
    public $icon;
    public $href;
    public $permission;
    public $subMenu;
    public $active;
    public $inurl;

    public function __construct($fillableAttributes = array())
    {
        $this->name = isset($fillableAttributes['name']) ? $fillableAttributes['name'] : '';
        $this->icon = isset($fillableAttributes['icon']) ? $fillableAttributes['icon'] : '';
        $this->href = isset($fillableAttributes['href']) ? $fillableAttributes['href'] : '';
        $this->inurl = isset($fillableAttributes['inurl']) ? $fillableAttributes['inurl'] : '';
        $this->permission = isset($fillableAttributes['permission']) ? $fillableAttributes['permission'] : false;
        $this->active = false;
        $this->subMenu = array();
        $this->servicePermission = app('\App\Services\Permission');
    }

    /*
     * Check if current menu item is active
     *
     * @return bool
     */
    public function isActive()
    {
        if($this->inurl !== '')
        {
            return strpos(Request::path(),substr($this->inurl,1)) !== false;
        }

        return substr($this->href,1) === Request::path();
    }

    /*
     * Check if user has permission to view menu item
     *
     * @return bool
     */
    public function hasPermission()
    {
        //Check permission

        //If permission false, free access to all
        if($this->permission === false)
        {
            return true;
        }

        //Check permission on user
        $user = Sentinel::check();
        if($user === false)
        {
            return false;
        }
        else
        {

            //Superadmin has access to all
            if($this->servicePermission->isSuperAdmin($user)) {
                return true;
            }

            //Is function
            if(is_callable($this->permission))
            {
                return (bool)$this->permission($user);
            }
            else
            {
                //Is string | array
                return (bool)$user->hasAccess($this->permission);
            }
        }
    }

    /*
     * Check if menu has sub menu items
     *
     * @return bool
     */
    public function hasSubMenu()
    {
        return count($this->subMenu) > 0;
    }
}