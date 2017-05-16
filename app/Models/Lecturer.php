<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 23:08
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Collection;

class Lecturer extends \Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'lecturer';

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

    /**
     * Link to User Profile
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Creator User Profile
     *
     * @return User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    /**
     * Batch
     *
     * @return Collection
     */
    public function batch()
    {
        return $this->hasMany(Batch::class, 'lecturer_id');
    }
}