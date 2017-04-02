<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 4/2/2017
 * Time: 12:16 PM
 */

namespace App\Http\Controllers;


class TestController extends Controller
{
    public function index() {
        die(\App\Models\User::all());
    }
}