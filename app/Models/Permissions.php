<?php
namespace App\Models;

class Permissions extends \Eloquent
{

    protected $table = "permissions";

    protected $fillable = [
        'slug',
        'name',
        'description'
    ];

}