<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\StageClassificationResource;
use App\Http\Resources\StageClassificationCollection;
use App\Models\StageClassification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class StageClassificationController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Get(
     *      path="/stages/classifications",
     *      summary="Returns an index of stage classifications",
     *      description="Returns all of stage classifications",
     *      operationId="classificationsIndex",
     *      @OA\Response(
     *          response=200,
     *          description="An index of all stage classifications",
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
     *                      property="classifications",
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
        return new StageClassificationCollection(StageClassification::all());
    }

    /**
     * @OA\Get(
     *      path="/stages/{id}/classifications",
     *      summary="Returns a stage's classifications",
     *      description="Returns a stage's classifications",
     *      operationId="classificationsShow",
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
     *          description="A stage's classifications",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/stage_classification",
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
    public function show(Request $request, string $id) {
        $classification = StageClassification::find($id);
        if (!$classification) {
            throw new ResourceNotFoundException();
        }
        return new StageClassificationResource($classification);
    }
}
