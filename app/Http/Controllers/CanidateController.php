<?php

namespace App\Http\Controllers;

use App\Models\Canidate;
use Illuminate\Http\Request;

class CanidateController extends Controller
{
    function index( Request $request){
        try{
            $user_id = $request->header('id');
            $profile = Canidate::where('user_id',$user_id)->first();
            return response()->json([
                'status' => 'success',
                'data' => $profile
            ]);
        }catch(\Exception $ex){
           return response()->json([
               'status' => 'error',
               'message' => $ex->getMessage()
           ]);
        }
    }

    function upadateOrCreate( Request $request){
        try{
            $user_id = $request->header('id');

            $name = $request->input('name');
            $email = $request->input('email');
            $father_name = $request->input('father_name');
            $mother_name = $request->input('mother_name');
            $date_of_birth = $request->input('date_of_birth');
            $blood_group = $request->input('blood_group');
            $Social_id = $request->input('Social_id');
            $Passport_id = $request->input('Passport_id');
            $cell_no = $request->input('cell_no');
            $emergency_no = $request->input('emergency_no');
            $linkedin = $request->input('linkedin');
            $facebook = $request->input('facebook');
            $github = $request->input('github');
            $portfolio_link = $request->input('portfolio_link');
            $image = $request->file('image');

            $time = time();
            $image_name =$name.'_'.$time.$image->getClientOriginalExtension();
            $image->move(public_path('img/canidate'),$image_name);
            $img_url = 'img/canidate/'.$image_name;

            $profile = Canidate::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'user_id' => $user_id,
                    'name' => $name,
                    'email' => $email,
                    'father_name' => $father_name,
                    'mother_name' => $mother_name,
                    'date_of_birth' => $date_of_birth,
                    'blood_group' => $blood_group,
                    'Social_id' => $Social_id,
                    'Passport_id' => $Passport_id,
                    'cell_no' => $cell_no,
                    'emergency_no' => $emergency_no,
                    'linkedin' => $linkedin,
                    'facebook' => $facebook,
                    'github' => $github,
                    'portfolio_link' => $portfolio_link,
                    'image' => $img_url
                ]
            );


            return response()->json([
                'status' => 'success',
                'message' => 'profile updated',
                'data' => $profile
            ]);
        }catch(\Exception $ex){
           return response()->json([
               'status' => 'error',
               'message' => $ex->getMessage()
           ]);
        }
    }
}
