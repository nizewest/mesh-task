<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->renderJson($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    protected function renderJson(Exception $exception)
    {
        $response = [];

        $statusCode = $this->getJsonStatusCode($exception);

        $response['error'] = $this->getJsonErrorMessage($exception, $statusCode);

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }

        return response()->json($response, $statusCode);
    }

    /**
     * @param  \Exception  $exception
     * @return int
     */
    protected function getJsonStatusCode(Exception $exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } elseif ($exception instanceof ModelNotFoundException) {
            $statusCode = 404;
        } else {
            $statusCode = 500;
        }

        return $statusCode;
    }

    /**
     * @param  \Exception  $exception
     * @param  int  $statusCode
     * @return string
     */
    protected function getJsonErrorMessage(Exception $exception, $statusCode)
    {
        switch ($statusCode) {
            case 404:
                $error = 'Not Found';
                break;

            case 403:
                $error = 'Forbidden';
                break;

            default:
                $error = $exception->getMessage();
                break;
        }

        return $error;
    }
}
