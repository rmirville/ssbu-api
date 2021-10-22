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
     *          schema="link",
     *          type="object",
     *          @OA\Property(
     *              property="href",
     *              type="string",
     *          ),
     *      ),
     *      @OA\Schema(
     *          schema="links",
     *          type="object",
     *          @OA\Property(
     *              property="self",
     *              type="object",
     *              ref="#/components/schemas/link",
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
     *          schema="stage_base",
     *          type="object",
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
     *          schema="stage",
     *          allOf={
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="_links",
     *                      @OA\Property(
     *                          property="index",
     *                          ref="#/components/schemas/link",
     *                      ),
     *                      @OA\Property(
     *                          property="self",
     *                          ref="#/components/schemas/link",
     *                      ),
     *                      @OA\Property(
     *                          property="classifications",
     *                          ref="#/components/schemas/link",
     *                      ),
     *                  ),
     *              ),
     *              @OA\Schema(ref="#/components/schemas/stage_base"),
     *          }
     *      ),
     *      @OA\Schema(
     *          schema="stage_summary",
     *          allOf={
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="_links",
     *                      ref="#/components/schemas/links",
     *                  ),
     *              ),
     *              @OA\Schema(ref="#/components/schemas/stage_base"),
     *          }
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
     *      @OA\Schema(
     *          schema="stage_piece",
     *          type="object",
     *          @OA\Property(
     *              property="lvd",
     *              type="string",
     *          ),
     *          @OA\Property(
     *              property="pieceName",
     *              type="string",
     *          ),
     *      ),
     *      @OA\Schema(
     *          schema="stage_piece_map",
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
     *              property="maps",
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/stage_piece"),
     *          ),
     *      ),
     *      @OA\Schema(
     *          schema="stage_piece_map_summary",
     *          type="object",
     *          @OA\Property(
     *              property="_links",
     *              ref="#/components/schemas/links",
     *          ),
     *          @OA\Property(
     *              property="id",
     *              ref="#/components/schemas/id",
     *          ),
     *      ),
     * ),
     */
}
