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

    protected $policy = '\App\Policies\Controllers\BatchControllerPolicy';


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
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Batch - Create';

        //Permissions
        $this->data['can_create_batch'] = true;

        //Assets
        $this->addJqueryValidate();

        $this->addJs('/js/el/batch.create.js');
        return $this->renderView('batch.create');


    }

    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'name' => 'required|max:255|alpha',
            'start_date' => 'required|date',

        ]);

        //Create New Batch
        $lecturer = new \App\Models\Batch();
        //Fill in information from request
        $lecturer->fill($request->all());
        //Set creator user id to user currently logged in
        $lecturer->creator_user_id = $this->user->id;
        //Save to database
        $batch->save();
    }





}




