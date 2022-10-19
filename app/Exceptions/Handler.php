<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\MultipleRecordsFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Ramsey\Collection\Exception\InvalidSortOrderException;

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
     * A list of the internal exception types that should not be reported.
     *
     * @var string[]
     */
    protected $internalDontReport = [
//        AuthenticationException::class,
//        AuthorizationException::class,
//        HttpException::class,
//        HttpResponseException::class,
//        ModelNotFoundException::class,
//        MultipleRecordsFoundException::class,
//        RecordsNotFoundException::class,
//        SuspiciousOperationException::class,
//        TokenMismatchException::class,
//        ValidationException::class,
    ];

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    /**
     * @inheritDoc
     */
    protected function context(): array
    {
        return array_merge(parent::context(), [
            'url' => \URL::full(),
        ]);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
//            if(request()->method() == 'POST'){
//                dd($e->getMessage(), $e->getCode());
//            }
            dd($e);
            if(isset($_GET['db'])){
                dd($e);
            }

            if (function_exists('slog')) {
                slog([
                    $e->getFile(),
                    $e->getLine(),
                    $e->getMessage(),
                    '1=>' . ($e->getTrace()[0]['file'] ?? 'null') . ' -- Line:' . ($e->getTrace()[0]['line'] ?? 'null') . ' -- function:' . ($e->getTrace()[0]['function'] ?? 'null') . ' -- class:' . ($e->getTrace()[0]['class'] ?? 'null'),
                    '2=>' . ($e->getTrace()[1]['file'] ?? 'null') . ' -- Line:' . ($e->getTrace()[1]['line'] ?? 'null') . ' -- function:' . ($e->getTrace()[1]['function'] ?? 'null') . ' -- class:' . ($e->getTrace()[1]['class'] ?? 'null'),
                    '3=>' . ($e->getTrace()[2]['file'] ?? 'null') . ' -- Line:' . ($e->getTrace()[2]['line'] ?? 'null') . ' -- function:' . ($e->getTrace()[2]['function'] ?? 'null') . ' -- class:' . ($e->getTrace()[2]['class'] ?? 'null'),
                    '4=>' . ($e->getTrace()[3]['file'] ?? 'null') . ' -- Line:' . ($e->getTrace()[3]['line'] ?? 'null') . ' -- function:' . ($e->getTrace()[3]['function'] ?? 'null') . ' -- class:' . ($e->getTrace()[3]['class'] ?? 'null'),
                ]);
            }
        });


    }//fn

    private function isNotFoundException($exception): bool
    {
        return $exception instanceof NotFoundHttpException
               || $exception instanceof ModelNotFoundException;
    }
}
