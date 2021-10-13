<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StagePieceMapResource;
use App\Http\Resources\StagePieceMapCollection;
use App\Models\StagePieceMap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class StagePieceMapController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Get(
     *      path="/stages/piece-maps",
     *      summary="Returns an index of stage piece maps",
     *      description="Returns an index of stage piece maps",
     *      operationId="pieceMapsIndex",
     *      @OA\Response(
     *          response=200,
     *          description="An index of all stage piece maps",
     *          @OA\JsonContent(
     *          type="object",
     *              @OA\Property(
     *                  property="_links",
     *                  ref="#/components/schemas/links",
     *              ),
     *              @OA\Property(
     *                  property="_embedded",
     *                  type="object",
     *                  @OA\Property(
     *                      property="pieceMaps",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/stage_piece_map_summary"),
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
        return new StagePieceMapCollection(StagePieceMap::all());
    }


    /**
     * @OA\Get(
     *      path="/stages/piece-maps/{piece-map-name}",
     *      summary="Returns a stage piece map",
     *      description="Returns a mapping of stages to selected pieces",
     *      operationId="getPieceMapByName",
     *      @OA\Parameter(
     *          name="piece-map-name",
     *          in="path",
     *          required=true,
     *          description="Name of stage piece map",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="A stage piece map",
     *          @OA\JsonContent(
     *          type="object",
     *              @OA\Property(
     *                  property="_links",
     *                  ref="#/components/schemas/links",
     *              ),
     *              ref="#/components/schemas/stage_piece_map"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="Unexpected error occured",
     *      ),
     * )
     */
    public function show(StagePieceMap $pieceMap) {
        return new StagePieceMapResource($pieceMap);
    }
}
