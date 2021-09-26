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
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="_links",
     *                      ref="#/components/schemas/links",
     *                  ),
     *                  @OA\Property(
     *                      property="_embedded",
     *                      type="object",
     *                      @OA\Property(
     *                          property="pieceMaps",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/stage_piece_map_summary"),
     *                      ),
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

    public function show(StagePieceMap $pieceMap) {
        return new StagePieceMapResource($pieceMap);
    }
}
