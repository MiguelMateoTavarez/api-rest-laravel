<?php

namespace App\Http\Controllers\API\V1\Library;

use App\Http\Controllers\API\V1\Controller;
use App\Http\Requests\API\V1\Author\StoreAuthorRequest;
use App\Http\Requests\API\V1\Author\UpdateAuthorRequest;
use App\Http\Resources\API\V1\AuthorResource;
use App\Models\Author;
use App\Services\API\V1\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponseService::success(
            AuthorResource::collection(Author::paginate()),
            'Authors retrieved successfully',
        );
    }

    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->validated());

        return ApiResponseService::success(
            new AuthorResource($author),
            'Author created successfully',
            Response::HTTP_CREATED,
        );
    }

    public function show(Author $author): JsonResponse
    {
        return ApiResponseService::success(
            new AuthorResource($author),
            'Author retrieved successfully'
        );
    }

    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        $author->update($request->validated());

        return ApiResponseService::success(
            new AuthorResource($author),
            'Author updated successfully'
        );
    }

    public function destroy(Author $author)
    {
        //TODO: Prevee que al momento de eliminar un autor dejar saber si tiene un libro relacionado
        $author->delete();

        return ApiResponseService::success(
            null,
            'Author deleted successfully',
        );
    }
}
