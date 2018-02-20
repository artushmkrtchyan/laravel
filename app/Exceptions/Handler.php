<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // This will replace our 404 response with
        // a JSON response.
        if ($exception instanceof ModelNotFoundException) {
            return response()->apiJson(false, Response::HTTP_NOT_FOUND, 'Resource not found.');
        }elseif ($exception instanceof NotFoundHttpException) {
            return response()->apiJson(false, Response::HTTP_NOT_FOUND, 'Please check the URL you submitted.');
        }elseif($exception instanceof AuthenticationException) {
            return response()->apiJson(false, Response::HTTP_FORBIDDEN, 'Unauthenticated.');
        }

        return response()->apiJson(false, Response::HTTP_BAD_REQUEST, $exception->getMessage());

        //return parent::render($request, $exception);
    }
}
