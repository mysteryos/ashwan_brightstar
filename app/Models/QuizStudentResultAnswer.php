<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/21/2017
 * Time: 2:53 PM
 */

namespace App\Models;


class QuizStudentResultAnswer extends \Eloquent
{
    protected $table = 'quiz_student_result_answer';

    protected $fillable = [
        'student_result_id',
        'answer_id',
        'question_id'
    ];

    /*
     * Relationships
     */

    /**
     * Result
     *
     * @return QuizStudentResult
     */
    public function result()
    {
        return $this->belongsTo(QuizStudentResult::class, 'student_result_id');
    }


    /**
     * Answer
     *
     * @return QuizAnswer
     */
    public function answer()
    {
        return $this->belongsTo(QuizAnswer::class, 'answer_id');
    }

    /**
     * Question
     *
     * @return QuizQuestion
     */
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }

}