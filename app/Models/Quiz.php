<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/20/2017
 * Time: 11:01 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Quiz extends \Eloquent
{
    protected $table = 'quiz';

    /*
     * Relationships
     */

    /**
     * Question
     *
     * @return Collection
     *
     */
    public function question()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    /**
     * Result
     *
     * @return
     */
    public function result()
    {
        return $this->hasMany(QuizStudentResult::class, 'quiz_id');
    }


    /**
     * Lecture
     *
     * @return mixed
     */
    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id');
    }
}