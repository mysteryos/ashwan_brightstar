<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ZxcvbnPhp\Zxcvbn;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Validator Extension
         */

        //Strong Password
        \Validator::extend('strong_password', function($attribute, $value, $parameters, $validator) {
            $zxcvbn = new Zxcvbn();
            $strength = $zxcvbn->passwordStrength($value);
            return $strength['score'] >= 2;
        });

        //Letters & Spaces
        \Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        \Blade::directive('avatar', function($user) {
            if($user) {
                $avatarColor = $user->getAvatarColor();
                return "<div class='avatar avatar-color-$avatarColor'>{$user->first_name[0]} {$user->last_name[0]}</div>";
            } else {
                return "<div class='avatar bgm-gray'>N/A</div>";
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
