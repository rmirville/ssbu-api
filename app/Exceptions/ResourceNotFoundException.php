<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ResourceNotFoundException extends ModelNotFoundException {
    protected $links;

    function __construct() {
        parent::__construct();
        $this->links = [
            '_links' => [
                'home' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                ],
            ],
        ];
    }

    public function render(Request $request) {
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
    }
}
