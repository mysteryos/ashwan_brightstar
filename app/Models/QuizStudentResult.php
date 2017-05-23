<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/20/2017
 * Time: 11:07 AM
 */

namespace App\Models;


class QuizStudentResult extends \Eloquent
{
    protected $table = 'quiz_student_result';

    protected $fillable = [
        'quiz_id',
        'student_id'
    ];

    /*
     * Relationships
     */

    /**
     * Student
     *
     * @return Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
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
     * Student Answer
     *
     * @return mixed
     */
    public function studentAnswer()
    {
        return $this->hasMany(QuizStudentResultAnswer::class, 'student_result_id');
    }
}