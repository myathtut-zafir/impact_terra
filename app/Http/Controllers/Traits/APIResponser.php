<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Response;

trait APIResponser
{
    public function respondCollection($message, $data)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
            'data' => $data,
        ], 201);
    }

    protected function respondPermissionDenied()
    {
        return response()->json([
            'code' => 403,
            'message' => 'Permission denied',
        ], 200);
    }

    protected function exceptionResponseValidation($msg, $code, $responseCode = 200, $name)
    {
        $result = [

            'code' => $code,
            $name => $msg,
        ];

        return response()->json($result, $responseCode);
    }
    protected function exceptionResponse($msg, $code, $responseCode = 400)
    {
        $result = [
            'code' => $code,
            'message' => $msg,
        ];

        return response()->json($result, $responseCode);
    }

    protected function errorResponse($msg)
    {
        $result = [
            'code' => 426,
            'message' => $msg,
        ];

        return response()->json($result, 200);
    }

    public function respondSuccessMsgOnly($message)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
        ], 200);
    }

    protected function clientApikeyInvalid() {
        $result = [
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => 'api key invalid',
        ];

        return response()->json($result, 401);
    }
    public function respondErrorToken($message)
    {
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => $message,
        ], 400);
    }
    public function respondErrorTokenExpire($message)
    {
        return response()->json([
            'code' => Response::HTTP_NOT_ACCEPTABLE,
            'message' => $message,
        ], Response::HTTP_NOT_ACCEPTABLE);
    }
}
