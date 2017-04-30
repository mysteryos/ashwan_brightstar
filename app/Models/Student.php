<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 23:14
 */

namespace App\Models;


class Student extends \Eloquent
{
    protected $table = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'address'
    ];

    /**
     * Additional attributes available on model
     *
     * @var array
     */
    protected $appends = ['name'];

    /**
     * ACCESSOR: Name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    /**
     * Relationships
     *
     */

    public function creator() {
        return $this->belongsTo(User::class,'creator_user_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}