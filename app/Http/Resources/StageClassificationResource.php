<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageClassificationResource extends JsonResource
{
    public $preserveKeys = true;

    public function href() {
        return env('SSBUTOOLS_API_HOST') . '/stages/' . $this->id . '/classifications';
    }

    public function summary() {
        return [
            '_links' => [
                'self' => [
                    'href' => $this->href(),
                ],
            ],
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
        return array_merge($this->summary(), [
            'abbr' => $this->abbr,
            'series' => $this->series,
            'tourneyPresence' => $this->tourneyPresence,
        ]);
    }
}
