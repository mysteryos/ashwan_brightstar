<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/16/2017
 * Time: 8:58 PM
 */

namespace App\Models;


class File extends \Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'file';

    protected $fillable = [
        'name',
        'extension',
        'mime',
        'path'
    ];

    /**
     * Relationship
     */

    /**
     * Creator
     *
     * @return User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }
}