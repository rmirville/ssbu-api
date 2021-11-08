<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected $links;

    function __construct(Container $container) {
        parent::__construct($container);
        $this->links = [
            '_links' => [
                'home' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                ],
            ],
        ];
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return response()->json(
                array_merge(
                    $this->links,
                    [
                        '_error' => [
                            'status' => 404,
                            'type' => 'ENDPOINT_NOT_FOUND',
                            'message' => 'The requested endpoint could not be found.',
                        ],
                    ],
                ),
                404
            );
        });
        $this->renderable(function (ModelNotFoundException $e, Request $request) {
            return response()->json(
                array_merge(
                    $this->links,
                    [
                        '_error' => [
                            'status' => 404,
                            'type' => 'RESOURCE_NOT_FOUND',
                            'message' => 'The requested resource could not be found.',
                        ],
                    ],
                ),
                404
            );
        });
    }
}
