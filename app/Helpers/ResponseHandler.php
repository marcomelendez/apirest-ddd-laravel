<?php

namespace App\Helpers;

abstract class ResponseHandler
{
    public static function success($data = [], int $codeStatus = 200)
    {
       return response()->json([
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => $data
        ], $codeStatus);
    }
    /**
    * @param int $codeStatus
    * @param array $error
    * @return \Illuminate\Http\JsonResponse
    */
    public static function errors(array $data = [], int $codeStatus = 401)
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => $data,
            ]
        ], $codeStatus);
    }
}
