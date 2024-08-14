<?php

namespace App\Http\Controllers\API\V1\Library;

use App\Http\Controllers\API\V1\Controller;
use App\Http\Requests\API\V1\Loan\StoreLoanRequest;
use App\Http\Resources\API\V1\LoanResource;
use App\Models\Book;
use App\Models\Loan;
use App\Services\API\V1\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{

    public function index(): JsonResponse
    {
        return ApiResponseService::success(
            LoanResource::collection(Loan::with(['book'])->paginate()),
            'Loans retrieved successfully',
        );
    }

    public function store(StoreLoanRequest $request): JsonResponse
    {
        if(!Book::find($request->book_id)->stock) {
            return ApiResponseService::error(
                'The book is out of stock',
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        $loan = Loan::create([
           'book_id' => $request->book_id,
           'loaned_at' => now(),
           'due_date' => now()->addDays(7),
           'returned' => false,
            'returned_at' => null,
        ]);

        $loan->book->update([
            'stock' => $loan->book->stock - 1,
        ]);

        return ApiResponseService::success(
            new LoanResource($loan->load('book')),
            'Loan created successfully',
            Response::HTTP_CREATED,
        );
    }

    public function show(Loan $loan): JsonResponse
    {
        return ApiResponseService::success(
            new LoanResource($loan->load('book')),
            'Loan retrieved successfully',
        );
    }

    public function returnLoan(Loan $loan): JsonResponse
    {
        if($loan->returned) {
            return ApiResponseService::error(
                'Loan already returned',
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        if(!$loan->isOwner()) {
            return ApiResponseService::error(
                'Access denied!',
                Response::HTTP_FORBIDDEN,
            );
        }

        $loan->update([
            'returned_at' => now(),
            'returned' => true,
        ]);

        $loan->book->update([
            'stock' => $loan->book->stock + 1,
        ]);

        return ApiResponseService::success(
            $loan->load('book'),
            'Loan updated successfully'
        );
    }
}
