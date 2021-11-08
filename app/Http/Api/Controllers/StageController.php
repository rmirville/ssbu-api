<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\StageResource;
use App\Http\Resources\StageCollection;
use App\Models\StageClassification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class StageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() { }

    /**
     * @OA\Get(
     *      path="/stages",
     *      summary="Returns an index of stages",
     *      description="Returns all stages",
     *      operationId="stagesIndex",
     *      @OA\Response(
     *          response=200,
     *          description="An index of all stages",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="_links",
     *                  type="object",
     *                  @OA\Property(
     *                      property="self",
     *                      ref="#/components/schemas/link",
     *                  ),
     *                  @OA\Property(
     *                      property="classifications",
     *                      ref="#/components/schemas/link",
     *                  ),
     *                  @OA\Property(
     *                      property="classificationSets",
     *                      ref="#/components/schemas/link",
     *                  ),
     *                  @OA\Property(
     *                      property="gameData",
     *                      ref="#/components/schemas/link",
     *                  ),
     *                  @OA\Property(
     *                      property="pieceMaps",
     *                      ref="#/components/schemas/link",
     *                  ),
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
        return new StageCollection(StageClassification::all());
    }

    /**
     * @OA\Get(
     *      path="/stages/{id}",
     *      summary="Returns a stage's index of operations",
     *      description="Returns a stage's index of operations",
     *      operationId="stagesShow",
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
     *          description="A stage's index of operations",
     *          @OA\JsonContent(ref="#/components/schemas/stage"),
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
        $stage = StageClassification::find($id);
        if (!$stage) {
            throw new ResourceNotFoundException();
        } else {
            $resource = new StageResource($stage);
        }
        return $resource;
    }
}
