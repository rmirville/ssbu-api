<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StageGameDataCollection extends ResourceCollection
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
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages/game-data',
                ],
                'index' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                ],
            ],
            '_embedded' => [
                'gameData' => $this->collection->map(function ($item) {
                        return $item->summary();
                    }
                ),
            ],
        ];
    }
}
