<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Contracts\API\Auth\AuthServiceInterface;
use App\Http\Controllers\API\V1\Controller;
use App\Http\Requests\API\V1\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    #[\App\Http\Controllers\API\V1\Info(version: '1.0.0', title: 'Library API')] public function __construct(private readonly AuthServiceInterface $authService)
    {
        parent::__construct();
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        return $this->authService->register($request->validated());
    }
}
