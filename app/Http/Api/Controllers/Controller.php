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
     *          schema="links",
     *          type="object",
     *          @OA\Property(
     *              property="self",
     *              type="object",
     *              @OA\Property(
     *                  property="href",
     *                  type="string",
     *              ),
     *          ),
     *      ),
     *      @OA\Schema(
     *          schema="id",
     *          type="string",
     *      ),
     *      @OA\Schema(
     *          schema="game_name",
     *          type="string",
     *          description="The stage's in-game ID",
     *      ),
     *      @OA\Schema(
     *          schema="name",
     *          type="string",
     *          description="The stage's name",
     *      ),
     *      @OA\Schema(
     *          schema="stage_summary",
     *          type="object",
     *          @OA\Property(
     *              property="_links",
     *              ref="#/components/schemas/links",
     *          ),
     *          @OA\Property(
     *              property="id",
     *              ref="#/components/schemas/id",
     *          ),
     *          @OA\Property(
     *              property="gameName",
     *              ref="#/components/schemas/game_name",
     *          ),
     *          @OA\Property(
     *              property="name",
     *              ref="#/components/schemas/name",
     *          ),
     *      ),
     *      @OA\Schema(
     *          schema="stage_classification",
     *          type="object",
     *          description="The collection of descriptors of a stage",
     *          @OA\Property(
     *              property="_links",
     *              ref="#/components/schemas/links",
     *          ),
     *          @OA\Property(
     *              property="id",
     *              ref="#/components/schemas/id",
     *          ),
     *          @OA\Property(
     *              property="gameName",
     *              ref="#/components/schemas/game_name",
     *          ),
     *          @OA\Property(
     *              property="name",
     *              ref="#/components/schemas/name",
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
