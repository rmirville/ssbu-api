<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StageClassificationResource;
use App\Http\Resources\StageClassificationCollection;
use App\Models\StageClassification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class StageClassificationController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Get(
     *      path="/stages/classifications",
     *      summary="Returns a list of stage classifications",
     *      description="Returns a list of stage classifications",
     *      operationId="index",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Items(ref="#/components/schemas/StageClassification"),
     *          ),
     *      ),
     * )
     */
    public function index() {
        return new StageClassificationCollection(StageClassification::all());
    }

    public function show(StageClassification $classification) {
        return new StageClassificationResource($classification);
    }
}
