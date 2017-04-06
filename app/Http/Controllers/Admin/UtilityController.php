<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 25/01/2016
 * Time: 09:08
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\VendorLibraries;
class UtilityController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->domainService = app('\App\Services\Domain\Admin\Utility');
    }

    public function getIndex()
    {
        $this->data = $this->domainService->index();

        return $this->renderView('admin.utility.index');
    }

    /**
     * POST: HR Think - Import employee data from excel
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postHrthinkImportExcel(Request $request)
    {
        $result = $this->domainService->postHrthinkImportExcel($this->user,$request);

        return redirect()->back()->with([
            'messages' => $result['messages']
        ]);

    }

    /**
     * POST: HR Think - Import leaves balance from excel
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postHrthinkImportLeavesDataExcel(Request $request)
    {
        $result = $this->domainService->postHrthinkImportLeaveBalanceExcel($this->user,$request);

        return redirect()->back()->with([
            'messages' => $result['messages']
        ]);

    }
}