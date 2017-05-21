<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/20/2017
 * Time: 11:02 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class QuizQuestion extends \Eloquent
{
    protected $table = 'quiz_question';


    /*
     * Relationships
     */

    /**
     * Answer
     *
     * @return Collection
     */
    public function answer()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id');
    }

    /**
     * Correct Answer
     *
     * @return QuizAnswer
     */
    public function correctAnswer()
    {
        return $this->belongsTo(QuizAnswer::class, 'correct_answer_id');
    }

    /**
     * Quiz
     *
     * @return Quiz
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

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