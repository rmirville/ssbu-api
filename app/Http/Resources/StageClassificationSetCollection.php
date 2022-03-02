<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\StageSet;

class StageClassificationSetCollection extends ResourceCollection
{
    public $collects = StageSet::class;
    public $preserveKeys = true;

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
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages/classification-sets',
                ],
                'index' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages',
                ],
            ],
            '_embedded' => [
                'classificationSets' => array_merge(
                    [$this->summary('all')],
                    $this->collection->map(function ($item) {
                            return $this->summary($item->id);
                        }
                    )->all(),
                )
            ],
        ];
    }

    protected function summary(string $id) {
        return [
            '_links' => [
                'self' => [
                    'href' => env('SSBUTOOLS_API_HOST') . '/stages/classification-sets/'.$id,
                ]
            ],
            'id' => $id,
        ];
    }
}
