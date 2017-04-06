<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@getIndex');


Route::get('/test', function() {
    die(var_dump(\App\Models\Lecture::all()->toArray()));
});

/*
 * User Routes
 */
Route::get('/login', 'UserController@login');

Route::get('/register', 'UserController@register');

Route::get('/forgot-password', 'UserController@forgotPassword');

Route::get('/logout', 'UserController@logout');

Route::get('/reset-password','UserController@resetPassword');

Route::get('/license-agreement','UserController@licenseAgreement');

/*
 * RESTFUL Controllers
 */

Route::controller('user', 'UserController');

/*
 * Administration Controllers
 */

Route::group(['namespace'=>'Admin','prefix'=>'admin'], function (){
    Route::controller('overview','OverviewController');
    Route::controller('users','UsersController');
    Route::controller('permissions','PermissionsController');
    Route::controller('roles','RolesController');
});

