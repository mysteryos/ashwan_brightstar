<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 07:45
 */

namespace app\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class BatchController extends Controller
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
        $this->data['pageTitle'] = 'Batch - List';

        //Set Data
        $this->data['batch_list'] = \App\Models\Batch::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_batch'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/batch.list.js');
        $this->addCss('/css/el/batch.list.css');

        return $this->renderView('batch.list');
    }

    public function getCreate()
    {

    }


}