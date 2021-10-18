<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StageClassificationCollection extends ResourceCollection
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
                'index' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                ],
                'self' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages/classifications',
                ],
            ],
            '_embedded' => [
                'classifications' => $this->collection->map(function ($item) {
                        return $item->summary();
                    }
                ),
            ],
        ];
    }
}
