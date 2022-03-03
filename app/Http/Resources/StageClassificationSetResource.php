<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\StageClassificationResource;

class StageClassificationSetResource extends ResourceCollection
{
    public $collects = StageClassificationResource::class;
    public $preserveKeys = true;
    protected $setId = '';

    function __construct($resource, $id) {

        parent::__construct($resource);
        $this->setId = $id;
    }

    protected function link(string $type) {
        $url = env('SSBUTOOLS_API_HOST') . '/stages';
        switch ($type) {
            case 'index':
                $url = $url . '/classification-sets';
                break;
            case 'self':
                $url = $url . '/classification-sets/' . $this->setId;
                break;
        }
        return [
            $type => [
                'href' => $url,
            ],
        ];
    }

    public function summary() {
        return array_merge(
            [
                '_links' => $this->link('self'),
            ],
            $this->baseProperties(),
        );
    }

    public function baseProperties() {
        return [
            'id' => $this->setId,
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_links' => array_merge(
                $this->link('self'),
                $this->link('index'),
            ),
            'classifications' => $this->collection->map(function ($item) {
                    return $item->classificationsSummary();
                }
            ),
        ];
    }
}
