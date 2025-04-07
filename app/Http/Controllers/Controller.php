<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * @param null $data
     * @param string|null $message
     * @param int|int $code
     * @return JsonResponse
     */
    protected function success($data = null, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    /**
     * @param string|null $message
     * @param int|int $code
     * @param null $errors
     * @return JsonResponse
     */
    protected function error(string $message = null, int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'message' => $message,
        ], $code);
    }
}
