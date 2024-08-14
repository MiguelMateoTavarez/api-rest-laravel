<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Contracts\API\Auth\AuthServiceInterface;
use App\Http\Controllers\API\V1\Controller;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    #[\App\Http\Controllers\API\V1\Info(version: '1.0.0', title: 'Library API')] public function __construct(private readonly AuthServiceInterface $authService)
    {
        parent::__construct();
    }

    public function __invoke(): JsonResponse
    {
        return $this->authService->logout();
    }
}
