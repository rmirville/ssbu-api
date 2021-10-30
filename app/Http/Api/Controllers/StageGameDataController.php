<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StageGameDataResource;
use App\Http\Resources\StageCollection;
use App\Models\StageGameData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

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
     *          description="An index of all stages",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="_links",
     *                  ref="#/components/schemas/links_index"
     *              ),
     *              @OA\Property(
     *                  property="_embedded",
     *                  type="object",
     *                  @OA\Property(
     *                      property="stages",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/stage_summary"),
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="Unexpected error occured",
     *      ),
     * )
     */
    public function index() {
        return new StageCollection(StageClassification::all());
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
     *          response="default",
     *          description="Unexpected error occured",
     *      ),
     * )
     */
    public function show(StageGameData $stage) {
        return new StageGameDataResource($stage);
    }
}
