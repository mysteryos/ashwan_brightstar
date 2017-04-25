<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 08:03
 */

namespace app\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class CourseController extends Controller
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
        $this->data['pageTitle'] = 'Course - List';

        //Set Data
        $this->data['course_list'] = \App\Models\Course::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_course'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/course.list.js');
        $this->addCss('/css/el/course.list.css');

        return $this->renderView('course.list');
    }

    public function getCreate()
    {

    }




}