<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/04/2017
 * Time: 22:23
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class LectureController extends Controller
{
    use VendorLibraries;

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        /*
         * Register Middleware
         */

        $this->middleware('auth');
    }

    public function getList()
    {
        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - List';

        //Set Data
        $this->data['lecture_list'] = \App\Models\Lecture::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_lecture'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/lecture.list.js');
        $this->addCss('/css/el/lecture.list.css');

        return $this->renderView('lecture.list');
    }

    public function getCreate()
    {

    }







}