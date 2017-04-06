<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 15/10/2015
 * Time: 14:28
 */

namespace App\Http\Controllers;

Use Log;
Use Sentinel;
use App\Traits\VendorLibraries;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    Use VendorLibraries;

    /**
     * Construct
     *
     * @param \App\Services\User $user
     */
    public function __construct(\App\Services\User $user)
    {
        parent::__construct();

        $this->service->user = $user;
        $this->domainService = app('\App\Services\Domain\User');
    }

    /**
     * GET: Login Page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login()
    {
        //If user is not logged in
        if ($this->user === false) {
            $this->data['pageTitle'] = "Login";

            $this->addJqueryValidate();
            $this->addJs('/js/el/login.js');

            $this->addCss('/css/el/login.css');

            return $this->renderView('user.login', false);
        } else {
            return redirect('/');
        }
    }

    /**
     * POST: Login
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        try {
            if ($this->service->user->loginByEmail($request->only(['email','password','remember_me']))) {
                return redirect()->intended('/');
            } else {
                return redirect('/login')->withErrors(['password_incorrect' => 'Your password is incorrect. Please try again.'])->withInput();
            }
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case 'Cartalyst\Sentinel\Checkpoints\NotActivatedException':
                    return redirect('/login')->withErrors(['not_activated' => 'Your account is not yet activated. Please contact BrightStar.']);
                    break;
                case 'Cartalyst\Sentinel\Checkpoints\ThrottlingException':
                    return redirect('/login')->withErrors(['throttling' => 'Please wait for some time before attempting to login again.']);
                    break;
                case 'Symfony\Component\HttpKernel\Exception\HttpException':
                    return redirect('/login')->withErrors(['http_exception' => $e->getMessage()])->withInput();
                    break;
                case 'App\Exceptions\HttpExceptionWithError':
                    return redirect('/login')->withErrors($e->getErrors());
                    break;
            }

            $this->errorHandler->report($e);
            return $this->errorHandler->render($request,$e);
        }
    }

    /**
     * GET: Register
     *
     * @return $this|\Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function register()
    {
        if ($this->user === false) {
            $this->data['pageTitle'] = "Register";

            $this->addZxcvbn();
            $this->addJqueryValidate();
            $this->addJs('/js/el/register.js');

            return $this->renderView('user.register',false);
        } else {
            return redirect('/')->withErrors(['already_signed_in' => 'Please sign out before trying to register']);
        }
    }

    /**
     * POST: Register
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        try {
            $user = $this->service->user->registerByEmail($request->only(['email', 'password', 'first_name', 'last_name','accept_agreement']));
            return redirect('/login')->with('messages',['Your account has been successfully created. Please contact HR for activation.']);
        }
        catch (\Exception $e) {
            switch(get_class($e)) {
                case 'Symfony\Component\HttpKernel\Exception\HttpException':
                    return redirect(action('UserController@register'))->withErrors(['http_exception'=>$e->getMessage()])->withInput();
                case 'App\Exceptions\HttpExceptionWithError':
                    return redirect(action('UserController@register'))->withErrors($e->getErrors())->withInput();
            }

            $this->errorHandler->report($e);
            return $this->errorHandler->render($request,$e);
        }
    }

    /**
     * GET: Forgot Password
     *
     * @return \Illuminate\View\View
     */
    public function forgotPassword()
    {
        $this->data['pageTitle'] = "Forgot Password";

        //Assets
        $this->addJqueryValidate();
        $this->addJs('/js/el/forgot_password.js');

        return $this->renderView('user.forgot_password', false);
    }

    /**
     * POST: Forgot Password
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postForgotPassword(Request $request)
    {
        try
        {
            $this->service->user->forgotPassword($request->only('email'));
            return redirect(action('UserController@login'))->with(['messages'=>'A email with the password reset instructions has been sent. Please check your mail in a few seconds']);
        }
        catch (\Exception $e)
        {
            switch(get_class($e)) {
                case 'Symfony\Component\HttpKernel\Exception\HttpException':
                    return redirect(action('UserController@forgotPassword'))->withErrors(['http_exception'=>$e->getMessage()])->withInput();
                case 'App\Exceptions\HttpExceptionWithError':
                    return redirect(action('UserController@forgotPassword'))->withErrors($e->getErrors())->withInput();
            }

            $this->errorHandler->report($e);
            return $this->errorHandler->render($request,$e);
        }
    }

    /**
     * GET: Reset Password
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function resetPassword(Request $request)
    {
        $this->data['pageTitle'] = "Reset Password";

        /*
         * Assets
         */
        $this->addJqueryValidate();
        $this->addZxcvbn();
        $this->addJs('/js/el/reset_password.js');

        /*
         * Data
         */

        $this->data['code'] = $request->input('code','');
        $this->data['email'] = $request->input('email','');

        return $this->renderView('user.reset_password', false);
    }

    /**
     * POST: Reset Password
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postResetPassword(Request $request)
    {
        try {

            $this->service->user->resetPassword($request->only(['email','code','password','password_confirm']));
            return redirect(action('UserController@login'))->with(['messages'=>'Your password was successfully reset']);
        }
        catch (\Exception $e) {
            $request->flash();
            switch(get_class($e)) {
                case 'Symfony\Component\HttpKernel\Exception\HttpException':
                    return redirect(action('UserController@resetPassword'))->withErrors(['http_exception'=>$e->getMessage()])->withInput();
                case 'App\Exceptions\HttpExceptionWithError':
                    return redirect(action('UserController@resetPassword'))->withErrors($e->getErrors())->withInput();
            }

            $this->errorHandler->report($e);
            return $this->errorHandler->render($request,$e);
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if($this->user)
        {
            Sentinel::logout();
        }

        return redirect(action('UserController@login'))->with(['messages'=>'You have been successfully logged out.']);
    }

    public function licenseAgreement()
    {
        $this->data = $this->domainService->licenseAgreement();

        $this->addCss('/css/el/terms_conditions.css');

        return $this->renderView('user.license_agreement',false);
    }

    /*
     * User Tour: START
     */

    /**
     * Save intro progress
     *
     * @param Request $request
     * @return Response
     */
    public function putIntro(Request $request)
    {
        $this->domainService->putIntro($this->user,$request->input());

        return response('Action successful');
    }

    /**
     * Delete intro progress
     *
     * @param Request $request
     * @return Response
     */
    public function deleteIntro(Request $request)
    {
        $this->domainService->deleteIntro($this->user,$request->input());

        return response('Delete successful');
    }

    /*
     * User Tour: END
     */
}