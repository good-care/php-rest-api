<?php

namespace App\Exceptions;

use App\Http\Controllers\DefaultController;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

    }

    public function render($request, Throwable $e): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if( $e instanceof ValidException) return $e->render($request);
        if ($request->isMethod('post') && ($e instanceof NotFoundHttpException || $e instanceof MethodNotAllowedHttpException))
            return (new DefaultController)->getDefaultJSONAnswer();

        return response()->json(
                new JsonAnswer(
                    0,
                    $e->getMessage(),
                    null
                ),
            500);

    }

}
