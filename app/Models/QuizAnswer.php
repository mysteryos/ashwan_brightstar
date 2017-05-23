<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/20/2017
 * Time: 11:03 AM
 */

namespace App\Models;


class QuizAnswer extends \Eloquent
{
    protected $table = 'quiz_answer';

    /**
     * Question
     *
     * @return QuizQuestion
     */
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class , 'question_id');
    }

    /**
     * Creator
     *
     * @return User
     */
    public function creator()
    {
        return $this->belongsTo(User::class , 'creator_user_id');
    }
}