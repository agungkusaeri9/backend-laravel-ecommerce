<?php

namespace App\Http\Controllers\Api;

class ResponseFormatter {

    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => NULL,
            'token' => NULL
        ],
        'data' => NULL
    ];

    public static function success($data = NULL,$message = NULL,$code = 200,$token = NULL)
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        self::$response['meta']['code'] = $code;
        self::$response['meta']['token'] = $token;

        return response()->json(self::$response,self::$response['meta']['code']);
    }

    public static function error($data = NULL,$message = NULL,$code = 400)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        return response()->json(self::$response,self::$response['meta']['code']);
    }

}
