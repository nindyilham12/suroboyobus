<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {   
        if ($exception instanceof ModelNotFoundException &&
        $request->wantsJson()){
            return response()->json([
                'data' => 'Resource not found'
            ], 404);
        }
        return parent::render($request, $exception);
    }
}
