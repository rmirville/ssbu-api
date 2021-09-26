<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StagePieceMapResource extends JsonResource
{
    public $preserveKeys = true;

    public function href() {
        return env('SSBUTOOLS_API_HOST') . '/stages/piece-maps/' . $this->id;
    }

    public function summary() {
        return [
            '_links' => [
                'self' => [
                    'href' => $this->href(),
                ],
            ],
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
        return array_merge($this->summary(), [
            'maps' => $this->maps,
        ]);
    }
}
