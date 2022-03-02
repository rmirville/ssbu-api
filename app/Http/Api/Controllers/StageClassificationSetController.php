<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\StageClassificationSetResource;
use App\Models\StageClassification;
use App\Models\StageSet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class StageClassificationSetController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Get(
     *      path="/stages/classification-sets",
     *      summary="Returns an index of stage classification sets",
     *      description="Returns all of stage classification sets",
     *      operationId="classificationSetsIndex",
     *      @OA\Response(
     *          response=200,
     *          description="An index of all stage classification sets",
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
     *                      property="classificationSets",
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
        return new StageClassificationCollection(StageClassification::all());
    }

    /**
     * @OA\Get(
     *      path="/stages/classification-sets/{set-name}",
     *      summary="Returns a set of classifications",
     *      description="Returns a set of classifications",
     *      operationId="classificationSetsShow",
     *      @OA\Parameter(
     *          name="set-name",
     *          in="path",
     *          required=true,
     *          description="Name of classification set",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="A set of classifications",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/stage_classification_set",
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
    public function show(Request $request, string $set) {
        $classifications = null;
        if ($set === 'all') {
            $classifications = StageClassification::all();
        } else {
            $stageSet = StageSet::find($set);
            if (!$stageSet) {
                throw new ResourceNotFoundException();
            }
            $keys = $stageSet->stages;
            $classifications = StageClassification::find($keys);
        }
        if (!$classifications) {
            throw new ResourceNotFoundException();
        }
        return new StageClassificationSetResource($classifications, $set);
    }
}
