<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 16/10/2015
 * Time: 13:48
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
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

        $this->domainService = app('\App\Services\Domain\Dashboard');
    }

    /**
     * GET: Index
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        /*
         * Display dashboard
         */

        $this->data = $this->domainService->getIndex($this->user);

        $this->addJs('/js/el/dashboard.index.js');
        $this->addCss('/css/el/dashboard.index.css');

        return $this->renderView('dashboard.index');
    }

    public function activate()
    {
        app('App\Services\User')->activate(3);
    }
}