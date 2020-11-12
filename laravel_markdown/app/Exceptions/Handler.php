<?php

namespace App\Exceptions;

use Cassandra\Custom;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//use App\Exceptions\CustomException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     * 리포트 무시하기
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
     * 모르겠음...
     * @return void
     */
    public function register()
    {
//        $this->reportable(function (CustomException $e) {
//
//        });
//
//        $this->renderable(function (CustomException $e, $request) {
//            return response()->view('errors.custom', [], 500);
//        });
    }
//    public function render($request, Exception $e)
//    {
//        if ($e instanceof ModelNotFoundException or $e instanceof NotFoundHttpException) {
//            return response(view('errors.notice', [
//                'title'       => 'Page Not Found',
//                'description' => 'Sorry, the page or resource you are trying to view does not exist.'
//            ]), 404);
//        }
//
//        return parent::render($request, $e);
//    }

}
