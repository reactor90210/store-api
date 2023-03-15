<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data, $code = 200, $message = null)
    {
        return response()->json([
            'status'=> 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($code, $message = null)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
