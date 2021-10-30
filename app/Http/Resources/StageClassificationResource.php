<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageClassificationResource extends JsonResource
{
    public $preserveKeys = true;

    protected function link(string $type) {
        $url = env('SSBUTOOLS_API_HOST') . '/stages';
        switch ($type) {
            case 'index':
                $url = $url . '/classifications';
                break;
            case 'stage':
                $url = $url . '/' . $this->id;
                break;
            case 'self':
                $url = $url . '/' . $this->id . '/classifications';
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
            'id' => $this->id,
            'gameName' => $this->gameName,
            'name' => $this->name,
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
        return array_merge(
            [
                '_links' => array_merge(
                    $this->link('self'),
                    $this->link('index'),
                    $this->link('stage'),
                ),
            ],
            $this->baseProperties(),
            [
                'abbr' => $this->abbr,
                'series' => $this->series,
                'tourneyPresence' => $this->tourneyPresence,
            ]
        );
    }
}
