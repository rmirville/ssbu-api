<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StageResource;
use App\Http\Resources\StageCollection;
use App\Models\StageClassification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class StageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Get(
     *      path="/stages/",
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
     *                  ref="#/components/schemas/links",
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
     *          response="default",
     *          description="Unexpected error occured",
     *      ),
     * )
     */
    public function show(StageClassification $stage) {
        return new StageResource($stage);
    }
}
