<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

trait Responses
{
    public function dataResponse(array|Collection|Model $params, string $message = '', int $httpCode = 200): JsonResponse
    {
        return $this->successResponse(params: $params, message: $message, httpCode: $httpCode);
    }

    public function successResponse(string $message = '', array|Collection|Model $params = [], int $httpCode = 201): JsonResponse
    {
        return response()->json($this->response($message, $params), $httpCode);
    }

    public function errorResponse(string $message, array $params = [], int $httpCode = 400): JsonResponse
    {
        return response()->json($this->response($message, $params), $httpCode);
    }

    private function response(string $message, array|Collection|Model $params): array
    {
        $response = [];
        if ($message) {
            $response['message'] = $message;
        }
        $params = $params instanceof Collection || $params instanceof Model ? $params->toArray() : $params;
        $response = $params ? array_merge($response, $params) : $response;
        return $response;
    }
}
