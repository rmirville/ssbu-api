<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StagePieceMapResource extends JsonResource
{
    public $preserveKeys = true;

    public function link(string $type) {
        $url = env('SSBUTOOLS_API_HOST') . '/stages/piece-maps';
        switch ($type) {
            case 'index':
                break;
            case 'self':
                $url = $url . '/' . $this->id;
        }
        return [
            $type => [
                'href' => $url,
            ],
        ];
    }

    public function href() {
        return env('SSBUTOOLS_API_HOST') . '/stages/piece-maps/' . $this->id;
    }

    public function summary() {
        return [
            '_links' => $this->link('self'),
            'id' => $this->id,
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
                    $this->link('index'),
                    $this->link('self'),
                ),
            ],
            [
            'maps' => $this->maps,
        ]);
    }
}
