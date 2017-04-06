<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 29/12/2015
 * Time: 15:04
 */

namespace App\Services;
/**
 * Class Dependency Resolver
 *
 * @description Helps in resolving all those services & repositories
 * @package App\Services\Domain
 */
use Sentinel;
class DependencyResolver
{
    private $_base_namespace = '\App';
    private $_class_type;
    private $user;

    public function __construct($class_type)
    {
        switch($class_type) {
            case 'repository':
                $this->_class_type = 'Repositories';
                break;
            case 'service':
                $this->_class_type = 'Services';
                break;
            case 'domain':
                $this->_class_type = 'Services\Domain';
                break;
            case 'elastic':
                $this->_class_type = 'Repositories\Elastic';
                break;
            case 'activity':
                $this->_class_type = 'Repositories\Activities';
                break;
        }

        $this->user = $this->resolveUser();
    }

    public function __get($name)
    {
        $this->exists($name);
        $this->{$name} = app($this->getFullClassName($name));
        $this->{$name}->user = $this->user;
        return $this->{$name};
    }

    private function getClassName($name)
    {
        return ucfirst($name);
    }

    private function getFullClassName($name)
    {
        return implode('\\',[$this->_base_namespace,$this->_class_type,$this->getClassName($name)]);
    }

    private function exists($name)
    {
        if(!class_exists($this->getFullClassName($name))) {
            throw new \RuntimeException("Unable to resolve class with name '$name' and class type '{$this->_class_type}'");
        }
    }

    public function setUser(\App\Models\User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setSystemUser()
    {
        $this->user = Sentinel::findUserById(\Config::get('website.system_user_id'));
        return $this;
    }

    private function resolveUser()
    {
        $sentinelUser = Sentinel::check();
        if($sentinelUser) {
            //If user logged in, we use it
            return $sentinelUser;
        } else {
            //Use system user
            return Sentinel::findUserById(\Config::get('website.system_user_id'));
        }
    }
}