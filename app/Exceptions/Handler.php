<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Illuminate\Session\TokenMismatchException;
use App\Exceptions\NotLoggedInException;
use App\Exceptions\HttpExceptionWithError;
use Illuminate\Contracts\Encryption\DecryptException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        NotLoggedInException::class,
        HttpExceptionWithError::class,
        DecryptException::class,
        ThrottlingException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if($e instanceof HttpException) {
            switch(get_class($e)) {
                case 'Symfony\Component\HttpKernel\Exception\HttpException':
                    if($request->ajax()) {
                        return response($e->getMessage(),$e->getStatusCode());
                    } else {
                        //Handle only bad requests
                        if($e->getStatusCode() === Response::HTTP_BAD_REQUEST) {
                            return redirect()->back()->withErrors(['http_exception' => $e->getMessage()])->withInput();
                        }
                    }
                    break;
                case 'App\Exceptions\HttpExceptionWithError':
                    if($request->ajax()) {
                        return response(implode(', ',$e->getErrors()->all()),$e->getStatusCode());
                    } else {
                        return redirect()->back()->withErrors($e->getErrors())->withInput();
                    }
                    break;
            }
        }

        switch (get_class($e)) {
            case 'App\Exceptions\NotLoggedInException':
                return redirect()->guest('/login')->withErrors($e->getMessage());
                break;
            case 'Illuminate\Contracts\Encryption\DecryptException':
            case 'Illuminate\Session\TokenMismatchException':
                return redirect()->back()->withErrors('Your session has expired. Please try again.');
                break;
            case 'Cartalyst\Sentinel\Checkpoints\NotActivatedException':
                \Sentinel::logout();
                return redirect()->guest('/login');
        }

        return parent::render($request, $e);
    }

    /**
     * Convert the given exception into a Response instance.
     * Allows us to replace whoops page with our server error page
     *
     * @param \Exception $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        $debug = config('app.debug', false);

        if ($debug) {
            return (new SymfonyDisplayer($debug))->createResponse($e);
        }

        return response()->view('errors.500', ['exception' => $e], 500);
    }
}
