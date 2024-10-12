<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {
        //     if (app()->bound('sentry')) {
        //         app('sentry')->captureException($e);
        //       }
        //     //
        // });
    }
    public function render($request, Throwable $exception)
    {
        // Handle ValidationException specifically for JSON responses
        if ($exception instanceof ValidationException) {
            return new JsonResponse([
                'message' => 'Validation failed',
                'errors' => $exception->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Handle NotFoundHttpException specifically for JSON responses
        if ($exception instanceof NotFoundHttpException) {
            return new JsonResponse([
                'message' => 'Resource not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        // Add more exception handling logic as needed for your API

        return parent::render($request, $exception);
    }




}
