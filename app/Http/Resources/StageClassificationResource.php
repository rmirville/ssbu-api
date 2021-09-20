<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageClassificationResource extends JsonResource
{
    public $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->_id,
            'gameName' => $this->gameName,
            'name' => $this->name,
            'abbr' => $this->abbr,
            'series' => $this->series,
            'tourneyPresence' => $this->tourneyPresence,
        ];
    }
}
