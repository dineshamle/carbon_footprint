<?php

namespace App\Http\Traits;

trait ApiResponse
{
    /**
     * Core of response
     */
    public function response($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess) {
            return response()->json([
                'error' => false,
                'code' => $statusCode,
                'message' => $message,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'error' => true,
                'code' => $statusCode,
                'message' => $message,
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->response($message, $data, $statusCode);
    }

    /**
     * Send any error response
     */
    public function error($message, $statusCode = 500)
    {
        return $this->response($message, null, $statusCode, false);
    }
}