<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 08:17
 */

namespace app\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class AssignmentController extends Controller
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
        $this->data['pageTitle'] = 'Assignment - List';

        //Set Data
        $this->data['assignment_list'] = \App\Models\Assignment::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_assignment'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/assignment.list.js');
        $this->addCss('/css/el/assignment.list.css');

        return $this->renderView('assignment.list');
    }

    public function getCreate()
    {

    }





}