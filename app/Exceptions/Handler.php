<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

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
        $this->reportable(function (Throwable $e) {
            //
        });

        // Handle validation exceptions
        $this->renderable(function (ValidationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        // Handle authentication exceptions
        $this->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }
        });

        // Handle database exceptions
        $this->renderable(function (QueryException $e, Request $request) {
            Log::error('Database query exception', [
                'message' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
                'url' => $request->url(),
                'method' => $request->method(),
                'user_id' => auth()->id(),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database error occurred',
                ], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan database. Silakan coba lagi.');
        });

        // Handle 404 exceptions
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found',
                ], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        // Handle method not allowed exceptions
        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Method not allowed',
                ], 405);
            }

            return response()->view('errors.405', [], 405);
        });

        // Handle general exceptions
        $this->renderable(function (Throwable $e, Request $request) {
            // Log the exception
            Log::error('Unhandled exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'url' => $request->url(),
                'method' => $request->method(),
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred',
                ], 500);
            }

            // In development, show detailed error
            if (app()->environment('local')) {
                return parent::render($request, $e);
            }

            // In production, show generic error page
            return response()->view('errors.500', [], 500);
        });
    }

    /**
     * Report or log an exception.
     */
    public function report(Throwable $e): void
    {
        // Log different types of exceptions with appropriate levels
        if ($e instanceof QueryException) {
            Log::error('Database error: ' . $e->getMessage(), [
                'exception' => $e,
                'context' => 'database',
            ]);
        } elseif ($e instanceof ValidationException) {
            Log::warning('Validation error: ' . $e->getMessage(), [
                'exception' => $e,
                'context' => 'validation',
            ]);
        } elseif ($e instanceof AuthenticationException) {
            Log::info('Authentication error: ' . $e->getMessage(), [
                'exception' => $e,
                'context' => 'authentication',
            ]);
        } else {
            Log::error('Application error: ' . $e->getMessage(), [
                'exception' => $e,
                'context' => 'application',
            ]);
        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Handle CSRF token mismatch
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'CSRF token mismatch. Please refresh the page.',
                ], 419);
            }

            return redirect()->back()
                ->with('error', 'Sesi telah berakhir. Silakan refresh halaman dan coba lagi.')
                ->withInput();
        }

        // Handle file upload errors
        if ($e instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'File too large. Maximum size is 5MB.',
                ], 413);
            }

            return redirect()->back()
                ->with('error', 'File terlalu besar. Ukuran maksimal adalah 5MB.')
                ->withInput();
        }

        return parent::render($request, $e);
    }
}
