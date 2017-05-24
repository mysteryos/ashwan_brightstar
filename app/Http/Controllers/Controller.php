<?php

namespace App\Http\Controllers;

use App\Services\DependencyResolver;
use Bust;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\NotLoggedInException;
use Sentinel;
use Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Jenssegers\Agent\Agent;
use App\Exceptions\HttpExceptionWithError;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $domainService;
    protected $user;
    protected $service;
    protected $repository;
    protected $js;
    protected $css;
    protected $data = [];
    protected $menu;
    protected $pageTitle = '';
    protected $websiteName;
    protected $headerView = 'header';
    protected $footerView = 'footer';
    protected $errorHandler;
    protected $detectAgent;
    protected $superAdmin = false;
    protected $buildPath;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->setDefaultCss();
        $this->setDefaultJs();

        $this->service = new \stdClass();
        $this->repository = new \stdClass();
        $this->user = Sentinel::check();
        $this->menu = app('\App\Services\Menu')->generate();
        $this->websiteName = \Config::get('website.name');
        $this->errorHandler = app('\App\Exceptions\Handler');
        $this->isSuperAdmin = app('\App\Services\Permission')->isSuperAdmin($this->user);
        $this->detectAgent = new Agent();
        $this->buildPath = public_path('build');

        $this->studentService = app('App\Services\Student');
        $this->lecturerService = app('App\Services\Lecturer');
    }

    /**
     * Setter: Header View
     *
     * @param $headerView
     */
    public function setHeaderView($headerView)
    {
        $this->headerView = $headerView;
    }

    /**
     * Setter: Footer View
     *
     * @param $footerView
     */
    public function setFooterView($footerView)
    {
        $this->footerView = $footerView;
    }

    /**
     * Set Default Css
     */
    private function setDefaultCss()
    {
        $this->css = $this->minifier(config('assets.css.'.app()->environment()));
    }

    /**
     * Sets Default JS Files
     */
    private function setDefaultJs()
    {
        $this->js = $this->minifier(config('assets.js.'.app()->environment()));
    }


    private function minifier($fileArray)
    {
        if(app()->environment('production')) {
            foreach($fileArray as &$filepath) {
                // Only paths for /js & /css is allowed
                if(preg_match('/^\/(js|css).*$/',$filepath)) {
                    //Construct build path
                    $buildPath = 'build'.$filepath;
                    //Fetch manifest from build path
                    $manifest = json_decode(file_get_contents(public_path(dirname($buildPath).'/rev-manifest.json')), true);
                    //If file is set in manifest
                    $fileName = basename($filepath);
                    if (isset($manifest[$fileName])) {
                        //ASSET_CDN should be declared without a trailing slash
                        $filepath = env('ASSET_CDN','').'/'.dirname($buildPath).'/'.$manifest[$fileName];
                    }
                }
            }
        }

        return $fileArray;
    }

    /**
     * Add CSS files to current CSS array
     *
     * @param $css
     * @param bool|false $before
     */
    protected function addCss($css,$before=false)
    {
        $css = $this->minifier((array)$css);

        if($before)
        {
            //Add to start of css array
            $this->css = array_merge($css,$this->css);
        }
        else
        {
            $this->css = array_merge($this->css,$css);
        }
    }

    /**
     * Add JS files to current JS array
     *
     * @param $js
     * @param bool|false $before
     */
    protected function addJs($js,$before=false)
    {
        $js = $this->minifier((array)$js);

        if($before)
        {
            $this->js = array_merge($js,$this->js);
        }
        else
        {
            $this->js = array_merge($this->js,$js);
        }

    }

    /**
     * Render page for view
     *
     * @param $viewPath
     * @param bool|true $useLayout
     * @return \Illuminate\View\View
     */
    protected function renderView($viewPath, $useLayout = true)
    {
        /*
         * Add Hammer Js if mobile/tablet
         */

        if($this->detectAgent->isMobile() || $this->detectAgent->isTablet()) {
            $this->addJs('/vendors/bower_components/hammerjs/hammer.min.js');
            $this->addJs('/vendors/bower_components/jquery-hammerjs/jquery.hammer.js');
        }

        /*
         * Set Data
         */


        $this->data['websiteName'] = $this->websiteName;
        $this->data['css'] = $this->css;
        $this->data['js'] = $this->js;
        $this->data['current_user'] = $this->user;
        $this->data['messages'] = Session::get('messages',null);
        $this->data['menu'] = $this->menu;
        $this->data['isSuperAdmin'] = $this->isSuperAdmin;

        if($this->user) {
            $this->user->load('student');
            $this->user->load('lecturer');
            if($this->user->student) {
                $this->data['view_profile_url'] = action('StudentController@getView',['student_id'=>$this->user->student->id]);
            } else if($this->user->lecturer) {
                $this->data['view_profile_url'] = action('LecturerController@getView',['lecturer_id'=>$this->user->lecturer->id]);
            } else {
                $this->data['view_profile_url'] = "javascript:void(0)";
            }
        }


        /*
         * Add DI resolver
         */

        $this->data['DIService'] = new DependencyResolver('service');

        /*
         * Header & Footer
         */
        $this->data['headerView'] = $this->headerView;
        $this->data['footerView'] = $this->footerView;

        //Use predefined layout
        if ($useLayout === false) {
            return view($viewPath, $this->data);
        } else {
            $this->data['mainView'] = $viewPath;
            return view('layout', $this->data);
        }
    }

    /**
     * Check if user has access to resource
     *
     * @param mixed|false $param
     * @throw RuntimeException | Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function verifyAccess($param = false)
    {
        $currentRouteName = Route::current()->getActionName();
        $currentActionArray = explode('@',$currentRouteName);
        $currentAction = array_pop($currentActionArray);

        //Policy Attribute set
        if(!isset($this->policy))
        {
            throw new \RuntimeException("Please set policy before verifying access.");
        }

        //Class Exists
        if(!class_exists($this->policy,true))
        {
            throw new \RuntimeException("Defined policy does not exist.");
        }

        $policy = new $this->policy($this->user);

        //Method Exists
        if(!method_exists($policy,$currentAction))
        {
            throw new \RuntimeException("Method for policy does not exist.");
        }

        //Current Action is allowed
        if(!$policy->$currentAction($param))
        {
            throw new HttpException(403,"You do not have access to this resource");
        }

    }

    /**
     * Validates data through Laravel's Validator
     *
     * @param array $data
     * @param array $rules
     * @throws HttpExceptionWithError
     */
    protected function validateData(array $data, array $rules)
    {
        $validator = app('Illuminate\Contracts\Validation\Factory')->make($data,$rules);
        if(!$validator->passes())
        {
            throw new HttpExceptionWithError(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
    }

    protected function hasAccess($permissions)
    {
        if($this->isSuperAdmin) {
            return true;
        }

        return $this->user->hasAccess($permissions);
    }
}
