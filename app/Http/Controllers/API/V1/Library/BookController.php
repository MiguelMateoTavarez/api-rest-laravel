<?php

namespace App\Http\Controllers\API\V1\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Book\StoreBookRequest;
use App\Http\Requests\API\V1\Book\UpdateBookRequest;
use App\Http\Requests\API\V1\Book\UpdateBookStockRequest;
use App\Http\Resources\API\V1\BookResource;
use App\Models\Book;
use App\Services\API\V1\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponseService::success(
            BookResource::collection(Book::with('author', 'gender')->paginate())->resource,
            'Books retrieved successfully'
        );
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());

        return ApiResponseService::success(
            new BookResource($book),
            'Book create successfully',
            Response::HTTP_CREATED
        );
    }

    public function show(Book $book): JsonResponse
    {
        return ApiResponseService::success(
            new BookResource($book),
            'Book retrieved successfully'
        );
    }

    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return ApiResponseService::success(
            new BookResource($book),
            'Book updated successfully'
        );
    }

    public function updateStock(UpdateBookStockRequest $request, Book $book): JsonResponse
    {
        $book->update([
            'stock' => data_get($request->validated(), 'stock'),
        ]);

        return ApiResponseService::success(
            new BookResource($book),
            'Book\'s stock updated successfully'
        );
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return ApiResponseService::success(
            null,
            'Book deleted successfully'
        );
    }
}
