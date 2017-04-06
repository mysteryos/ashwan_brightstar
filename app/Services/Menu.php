<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 22/10/2015
 * Time: 07:53
 */

namespace App\Services;

Use Sentinel;
class Menu extends Service
{
    private $mainMenu = array();

    /*
     * Return list of available menu items
     */
    public function generate()
    {
        $menu = $this->getMenuConfig();
        foreach($menu as $menuItem)
        {
            $this->fill($menuItem);
        }

        return $this->mainMenu;
    }

    /*
     * Get Menu from config
     * @return array
     */
    private function getMenuConfig()
    {
        return \Config::get('menu');
    }

    /*
     * Cast menu objects recursively
     */
    private function fill($menuItem,&$currentMenuItem = false)
    {
        $menuObj = new \App\Models\Menu($menuItem);
        if($currentMenuItem === false)
        {
            $this->mainMenu[] = $menuObj;
        }
        else
        {
            $currentMenuItem->subMenu[] = $menuObj;
        }

        if(isset($menuItem['sub']) && count($menuItem['sub']) > 0)
        {
            foreach($menuItem['sub'] as $menuSubItem)
            {
                $this->fill($menuSubItem,$menuObj);
            }
        }
    }
}