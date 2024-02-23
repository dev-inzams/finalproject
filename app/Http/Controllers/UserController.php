<?php

namespace App\Http\Controllers;

use App\Models\Canidate;
use App\Models\Employee;
use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {


    // users Resgistration api
    function userRegistration(Request $request) {
        try{
            $request->validate([
                'type' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            $type = $request->input('type');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));

            if($type == 'employee'){
                $user = User::create([
                    'email' => $email,
                    'type' => 'employee',
                    'password' => $password
                ]);
                $token = JWTToken::CreateToken( $email , $user->id, $user->type);
                return response()->json([
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'type' => $user->type
                ], 200)->cookie( 'token', $token);
            }else{
                $user = User::create([
                    'email' => $email,
                    'type' => 'canidate',
                    'password' => $password
                ]);
                $token = JWTToken::CreateToken( $email , $user->id, $user->type);
                return response()->json([
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'type' => $user->type
                ], 200)->cookie( 'token', $token);
            }




        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 200);
        }

    } // end of userRegistration


    // users login api
    public function UserLogin(Request $request){
        try{
            $email = $request->input('email');
            $password = $request->input('password');
            $user = User::where('email', $email)->first();
            if(Hash::check($password, $user->password)){
               $token = JWTToken::CreateToken( $email , $user->id, $user->type);
                return response()->json([
                    'status' => 'success',
                    'message' => 'User logged in successfully',
                    'type' => $user->type
                ],200)->cookie( 'token', $token);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'User login failed',
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'user login failed',
            ],200);
        }
    } // end of login

    // user logout
    public function UserLogout(){
        return redirect('/login')->cookie( 'token', '', -1 );
    }

    // SendOTPCode
    public function SendOTPCode(Request $request){
        try{
            $email = $request->input('email');
            $otp = rand(1000, 9999);
            $user = User::where('email', $email)->count();
            if($user == 1){
                Mail::to($email)->send(new OTPMail($otp));
                User::where('email', $email)->update([
                    'otp' => $otp
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => '4 Digite OTP sent successfully',
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'user not found',
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],200);
        }
    } // end of SendOTPCode

    // verify otp
    public function VerifyOTPCode(Request $request){
        try{
            $email = $request->input('email');
            $otp = $request->input('otp');
            $user = User::where('email', $email)->first();
            if($user->otp == $otp){
                User::where('email', $email)->update([
                    'otp' => '0'
                ]);
                $token = JWTToken::ResetPasswordToken( $email );
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP verification successfully',
                ])->cookie( 'token', $token, 60*24*30);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'OTP Dont match',
                ],200);
            } // end of if

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'OTP verification failed',
            ],200);
        } // end of try
    } // end of VerifyOTPCode


       // reset password
       public function ResetPassword(Request $request){
        try{
            $email = $request->header('email');
            $password = Hash::make($request->input('password'));
            $updatePass = User::where('email','=', $email)->update([
                'password' => $password
            ]);
            if($updatePass){
                return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully',
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => $email.' user not found',
                ],200);
            }

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Password reset failed',
            ],200);
        } // end of try

    } // end of ResetPassword
}
