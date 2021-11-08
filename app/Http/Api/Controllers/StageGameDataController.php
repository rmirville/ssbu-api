<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\StageGameDataResource;
use App\Http\Resources\StageGameDataCollection;
use App\Models\StageGameData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class StageGameDataController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Get(
     *      path="/stages/game-data",
     *      summary="Returns an index of stages' game data",
     *      description="Returns a summary of all stages' game data",
     *      operationId="stageGameDataIndex",
     *      @OA\Response(
     *          response=200,
     *          description="An index of all stages' game data",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="_links",
     *                  ref="#/components/schemas/links_index",
     *              ),
     *              @OA\Property(
     *                  property="_embedded",
     *                  type="object",
     *                  @OA\Property(
     *                      property="gameData",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(
     *                              property="_links",
     *                              ref="#/components/schemas/links",
     *                          ),
     *                          @OA\Property(
     *                              property="id",
     *                              ref="#/components/schemas/id",
     *                          ),
     *                          @OA\Property(
     *                              property="name",
     *                              ref="#/components/schemas/name",
     *                          ),
     *                      ),
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          ref="#/components/responses/resource_not_found",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          ref="#/components/responses/server_error",
     *      ),
     * )
     */
    public function index() {
        return new StageGameDataCollection(StageGameData::all());
    }

    /**
     * @OA\Get(
     *      path="/stages/{id}/game-data",
     *      summary="Returns a stage's game data",
     *      description="Returns a stage's game data",
     *      operationId="stageGameDataShow",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Id of stage",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="A stage's game data",
     *          @OA\JsonContent(ref="#/components/schemas/stage_game_data"),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          ref="#/components/responses/resource_not_found",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          ref="#/components/responses/server_error",
     *      ),
     * )
     */
    public function show(Request $request, string $id) {
        $stage = StageGameData::find($id);
        if (!$stage) {
            throw new ResourceNotFoundException();
        }
        return new StageGameDataResource($stage);
    }
}
