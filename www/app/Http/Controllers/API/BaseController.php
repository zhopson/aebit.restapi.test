<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Symfony\Component\HttpFoundation\Cookie;
//use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponseAuth($result, $token, $minutes, $message)
    {
      $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200)->cookie('auth_token', $token, $minutes);//auth_token
    }
    
    public function sendResponseLogout($message)
    {
      $response = [
            'success' => true,
            'message' => $message,
        ];
        return response()->json($response, 200)->withoutCookie('auth_token');
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
      $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    
    public function sendResponseTest($message)
    {
      $response = [
            'success' => true,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }    
}
