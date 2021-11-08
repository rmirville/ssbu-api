<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SerializeExceptions
{
    /**
     * Catch unhandled exceptions and morph them into a json response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $status = $response->status();
        if ($status >= 500) {
            // set default error message
            $errorData = [
                '_links' => [
                    'home' => [
                        'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                    ],
                ],
                '_error' => [
                    'type' => 'SERVER_ERROR',
                    'message' => 'An unexpected error occured.',
                    'status' => $status,
                ]
            ];
            $errorContent = json_encode($errorData);
            $headers = ['Content-type' => 'application/json'];
            $newResponse = new JsonResponse($errorContent, $status, $headers, 0, true);
            $response = $newResponse;
        }
        return $response;
    }
}
