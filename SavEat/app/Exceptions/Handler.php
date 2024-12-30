<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (Throwable $e) {
            if ($e instanceof AuthorizationException) {
                return response()->view('errors.error', [
                    'errorCode' => '403',
                    'message' => __('Esta acción no está autorizada.')
                ], 403);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->view('errors.error', [
                    'errorCode' => '404',
                    'message' => __('Página no encontrada.')
                ], 404);
            }
        });
    }
}
