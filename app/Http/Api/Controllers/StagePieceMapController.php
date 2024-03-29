<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\StagePieceMapResource;
use App\Http\Resources\StagePieceMapCollection;
use App\Models\StagePieceMap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

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
     *                  ref="#/components/schemas/links_index",
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
     *          @OA\JsonContent(ref="#/components/schemas/stage_piece_map"),
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
        $pieceMap = StagePieceMap::find($id);
        if (!$pieceMap) {
            throw new ResourceNotFoundException();
        }
        return new StagePieceMapResource($pieceMap);
    }
}
