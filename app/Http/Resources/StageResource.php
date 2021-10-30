<?php

namespace App\Http\Resources;

class StageResource extends StageClassificationResource
{
    public $preserveKeys = true;

    public function link(string $type) {
        $url = env('SSBUTOOLS_API_HOST') . '/stages';
        switch ($type) {
            case 'self':
                $url = $url . '/' . $this->id;
                break;
            case 'classifications':
                $url = $url . '/' . $this->id . '/classifications';
                break;
            case 'gameData':
                $url = $url . '/' . $this->id . '/game-data';
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
            $this->properties()
        );
    }

    public function properties() {
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
                    $this->link('index'),
                    $this->link('self'),
                    $this->link('classifications'),
                    $this->link('gameData'),
                ),
            ],
            $this->properties()
        );
    }
}
