<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected function jsonResponse($data = null, $statusCode = 200) : JsonResponse
    {
        switch ($statusCode) {
            case 200:
                return response()->json(['status' => true, 'message' => 'Success', 'data' => $data], $statusCode);
            case 201:
                return response()->json(['status' => true, 'message' => 'Created', 'data' => $data], $statusCode);
            case 204:
                return response()->json(['status' => true, 'message' => 'No Content'], $statusCode);
            case 400:
                return response()->json(['status' => false, 'message' => 'Bad Request'], $statusCode);
            case 401:
                return response()->json(['status' => false, 'message' => 'Unauthorized'], $statusCode);
            case 403:
                return response()->json(['status' => false, 'message' => 'Forbidden'], $statusCode);
            case 404:
                return response()->json(['status' => false, 'message' => 'Not Found'], $statusCode);
            case 422:
                return response()->json(['status' => false, 'message' => 'Unprocessable Entity'], $statusCode);
            case 500:
                return response()->json(['status' => false, 'message' => 'Internal Server Error'], $statusCode);
            default:
                return response()->json(['status' => false, 'message' => 'Server Error'], 500);
        }
    }

}
