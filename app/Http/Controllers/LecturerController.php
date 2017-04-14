<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 4/14/2017
 * Time: 3:33 PM
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;
class LecturerController extends Controller
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
        $this->data['pageTitle'] = 'Student - List';

        //Set Data
        $this->data['student_list'] = \App\Models\Student::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_student'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/student.list.js');
        $this->addCss('/css/el/student.list.css');

        return $this->renderView('student.list');
    }

    public function getCreate()
    {

    }
}