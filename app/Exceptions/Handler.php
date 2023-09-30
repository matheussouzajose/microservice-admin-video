<?php

namespace App\Exceptions;

use Core\Domain\Exception\EmailAlreadyInUseException;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use KeycloakGuard\Exceptions\TokenException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): \Illuminate\Http\Response|JsonResponse|Response
    {
        if ($e instanceof NotFoundException) {
            return $this->showError($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof EntityValidationException) {
            return $this->showError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($e instanceof NotificationException) {
            return $this->showError($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } // ok => HTTP_INTERNAL_SERVER_ERROR

        if ($e instanceof TokenException) {
            return $this->showError($e->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof EmailAlreadyInUseException) {
            return $this->showError($e->getMessage(), Response::HTTP_CONFLICT);
        }

        return parent::render($request, $e);
    }

    private function showError(string $message, int $statusCode): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}
