<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 15/10/2015
 * Time: 16:29
 */

namespace App\Repositories;

class User extends Repository
{
    public function __construct(\App\Models\User $model)
    {
        parent::__construct($model);
    }

    /**
     * User's email exists
     *
     * @param string $email
     * @return bool
     */
    public function emailExists($email)
    {
        return (bool)$this->model
                ->newQuery()
                ->where('email','=',$email)
                ->count();
    }

    /**
     * Get By Email
     *
     * @param string $email
     * @return \App\Models\User
     */
    public function getByEmail($email)
    {
        return $this->model
            ->newQuery()
            ->where('email','=',$email)
            ->first();
    }

    /*
     * Validation: Start
     */

    /**
     * Validation: Register user by email
     *
     * @return array
     */
    public function getRegisterEmailValidationRules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:254|unique:users',
            'password' => 'required|min:7|max:60|strong_password',
            'accept_agreement' => 'required'
        ];
    }

    /**
     * Login User By Email
     *
     * @return array
     */

    public function getLoginEmailValidationRules()
    {
        return [
            'email' => 'required|email|max:254',
            'password' => 'required|min:5|max:60'
        ];
    }

    /**
     * Save User
     *
     * @param int $user_id
     * @return array
     */

    public function getSaveUserValidationRules($user_id)
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:254|unique:users,email,'.$user_id,
            'password' => 'sometimes|min:7|max:60',
            'password_confirm' => 'same:password'
        ];
    }

    /**
     * Forgot Password
     *
     * @return array
     */

    public function getForgotPasswordValidationRules()
    {
        return [
            'email' => 'required|email|max:254|exists:users'
        ];
    }

    /*
     * Reset Password
     */

    public function getResetPasswordValidationRules()
    {
        return [
            'email' => 'required|email|max:254|exists:users',
            'code' => 'required',
            'password' => 'required|min:7|max:60|strong_password',
            'password_confirm' => 'same:password'
        ];
    }

    /*
     * Validation: End
     */

    /*
     * Get all users from the database
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model
                ->newQuery()
                ->orderBy('created_at','DESC')
                ->get();
    }

    /**
     * Gets all users who are activated
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllActivated()
    {
        return $this->model
            ->newQuery()
            ->has('activations')
            ->where('id','!=',\Config::get('website.system_user_id'))
            ->orderBy('first_name','ASC')
            ->orderBy('last_name','DESC')
            ->GET();
    }
}