<?php

namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    public static function CreateToken($userEmail,$userID){
    try{
        $key = env('JWT_SECRET');
        $payload = [
            'iss' => env('APP_URL'),
            'iat' => time(),
            'exp' => time() + 60*60,
            'userEmail' => $userEmail,
            'userID' => $userID
        ];
        return JWT::encode($payload, $key, 'HS256');
    }catch(\Exception $e){
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ],200);
    }

    } // end of CreateToken


    // reset password token
    public static function ResetPasswordToken($userEmail){
        try{
            $key = env('JWT_SECRET');
            $payload = [
                'iss' => env('APP_URL'),
                'iat' => time(),
                'exp' => time() + 60*5,
                'userEmail' => $userEmail,
                'userID' => '0'
            ];
            return JWT::encode($payload, $key, 'HS256');
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],200);
        } // end of try
    } // end of ResetPasswordToken


    public static function VerifyToken($token){
        try{
            if($token == null){
                return 'unauthorized';
            }else{
                $key = env('JWT_SECRET');
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return $decoded;
            }

        }catch(\Exception $e){
            return 'unauthorized';
        }
    } // end of VerifyToken



}
