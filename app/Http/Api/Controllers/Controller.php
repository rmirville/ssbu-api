<?php

namespace App\Http\Api\Controllers;

class Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="SSBUTools API",
     *      description="RESTful API providing data related to Super Smash Bros. Ultimate assets",
     *      @OA\Contact(
     *          name="Raynald Mirville",
     *          email="admin@ssbutools.com",
     *      ),
     * ),
     * @OA\Server(
     *      url=SWAGGER_BASE_URL,
     *      description="SSBUTools API Server",
     * ),
     * @OA\Tag(
     *      name="Stage Classifications",
     *      description="API Endpoints of Stage Classifications"
     * ),
     * @OA\Components(
     *      @OA\Schema(
     *          schema="StageClassification",
     *          type="object",
     *          description="The collection of descriptors of a stage",
     *          @OA\Property(
     *              property="id",
     *              type="string",
     *          ),
     *          @OA\Property(
     *              property="gameName",
     *              type="string",
     *              description="The stage's in-code ID"
     *          ),
     *          @OA\Property(
     *              property="name",
     *              type="string",
     *              description="The stage's name",
     *          ),
     *          @OA\Property(
     *              property="abbr",
     *              type="string",
     *              description="The stage's abbreviated name",
     *          ),
     *          @OA\Property(
     *              property="series",
     *              type="string",
     *              description="The stage's video game series of origin",
     *          ),
     *          @OA\Property(
     *              property="tourneyPresence",
     *              type="integer",
     *              description="The stage's presence in major tournaments",
     *          ),
     *      ),
     * ),
     */
}
