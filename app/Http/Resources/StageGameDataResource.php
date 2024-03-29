<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageGameDataResource extends JsonResource
{
    public $preserveKeys = true;

    public function link(string $type) {
        $url = env('SSBUTOOLS_API_HOST') . '/stages';
        switch ($type) {
            case 'index':
                $url = $url . '/game-data';
                break;
            case 'stage':
                $url = $url . '/' . $this->id;
                break;
            case 'self':
                $url = $url . '/' . $this->id . '/game-data';
        }
        return [
            $type => [
                'href' => $url,
            ],
        ];
    }

    public function href() {
        return env('SSBUTOOLS_API_HOST') . '/stages/' . $this->id . '/game-data';
    }

    public function summary() {
        return [
            '_links' => $this->link('self'),
            'id' => $this->id,
            'name' => $this->data[0]['name'],
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
            [
            'data' => $this->data,
        ]);
    }
}
