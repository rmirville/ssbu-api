<?php

namespace App\JsonApi\StageClassifications;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'stage-classifications';

    /**
     * @param \App\StageClassification $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\StageClassification $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'gameName' => $resource->gameName,
            'name' => $resource->name,
            'abbr' => $resource->abbr,
            'series' => $resource->series,
            'tourneyPresence' => $resource->tourneyPresence,
        ];
    }
}
