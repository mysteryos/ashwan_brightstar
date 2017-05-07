<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 19:08
 */

namespace App\Models;


class Course extends \Eloquent
{
    protected $table = 'course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'duration_months',
        'description'];

    /*
     * Relationships
     */

    /**
     * Lectures: One-To-Many
     *
     * @return mixed
     */
    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'lecture_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }
}