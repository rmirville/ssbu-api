<?php

namespace App\Http\Resources;

use App\Http\Resources\StageClassificationCollection;

class StageCollection extends StageClassificationCollection
{

    private function link(string $types) {
        $url = env('SSBUTOOLS_API_HOST') . '/stages';

        switch ($types) {
            case 'self':
                break;
            case 'classifications':
                $url = $url . '/classifications';
                break;
            case 'classificationSets':
                $url = $url . '/classification-sets';
                break;
        }
        return [
            $types => [
                'href' => $url,
            ],
        ];
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_links' => array_merge(
                $this->link('self'),
                $this->link('classifications'),
                $this->link('classificationSets'),
            ),
            '_embedded' => [
                'stages' => $this->collection->map(function ($item) {
                    return $item->summary();
                }),
            ],
        ];
    }
}
