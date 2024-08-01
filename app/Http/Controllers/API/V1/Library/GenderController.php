<?php

namespace App\Http\Controllers\API\V1\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Gender\StoreGenderRequest;
use App\Http\Requests\API\V1\Gender\UpdateGenderRequest;
use App\Http\Resources\API\V1\AuthorResource;
use App\Http\Resources\API\V1\GenderResource;
use App\Models\Gender;
use App\Services\API\V1\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenderController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponseService::success(
            GenderResource::collection(Gender::paginate())->resource,
            'Genders retrieved successfully'
        );
    }

    public function store(StoreGenderRequest $request): JsonResponse
    {
        $gender = Gender::create($request->validated());

        return ApiResponseService::success(
            new AuthorResource($gender),
            'Gender created successfully',
            Response::HTTP_CREATED
        );
    }

    public function show(Gender $gender): JsonResponse
    {
        return ApiResponseService::success(
            new GenderResource($gender),
            'Gender retrieved successfully'
        );
    }

    public function update(UpdateGenderRequest $request, Gender $gender): JsonResponse
    {
        $gender->update($request->validated());

        return ApiResponseService::success(
            new GenderResource($gender),
            'Gender update successfully'
        );
    }

    public function destroy(Gender $gender): JsonResponse
    {
        $gender->delete();

        return ApiResponseService::success(
            null,
            'Gender deleted successfully'
        );
    }
}
