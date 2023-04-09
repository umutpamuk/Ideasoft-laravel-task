<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected function jsonResponse($data = null, $statusCode = 200) : JsonResponse
    {
        return match ($statusCode) {
            200 => response()->json(['status' => true, 'message' => 'Success', 'data' => $data], $statusCode),
            201 => response()->json(['status' => true, 'message' => 'Created', 'data' => $data], $statusCode),
            204 => response()->json(['status' => true, 'message' => 'No Content'], $statusCode),
            400 => response()->json(['status' => false, 'message' => 'Bad Request'], $statusCode),
            401 => response()->json(['status' => false, 'message' => 'Unauthorized'], $statusCode),
            403 => response()->json(['status' => false, 'message' => 'Forbidden'], $statusCode),
            404 => response()->json(['status' => false, 'message' => 'Not Found'], $statusCode),
            422 => response()->json(['status' => false, 'message' => 'Unprocessable Entity'], $statusCode),
            500 => response()->json(['status' => false, 'message' => 'Internal Server Error'], $statusCode),
            default => response()->json(['status' => false, 'message' => 'Server Error'], 500),
        };
    }

}
