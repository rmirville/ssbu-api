<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StagePieceMapCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_links' => [
                'self' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages/piece-maps/',
                ],
                'index' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                ],
            ],
            '_embedded' => [
                'pieceMaps' => $this->collection->map(function ($item) {
                        return $item->summary();
                    }
                ),
            ],
        ];
    }
}
