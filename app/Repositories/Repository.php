<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 15/10/2015
 * Time: 13:26
 */

namespace App\Repositories;

class Repository
{
    protected $model;

    public function __construct($model = false)
    {
        if ($model !== false) {
            $this->model = $model;
        }
    }

    /*
     * Model: Getter
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /*
     * Model: Setter
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

}