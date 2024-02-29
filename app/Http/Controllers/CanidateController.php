<?php

namespace App\Http\Controllers;

use App\Models\Canidate;
use App\Models\CanidateEdu;
use App\Models\CanidateJobexperience;
use App\Models\CanidateProTra;
use App\Models\Skil;
use Illuminate\Http\Request;

class CanidateController extends Controller {
    function index( Request $request ) {
        try {
            $user_id = $request->header( 'id' );
            $profile = Canidate::where( 'user_id', $user_id )->first();
            return response()->json( [
                'status' => 'success',
                'data'   => $profile,
            ] );
        } catch ( \Exception $ex ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $ex->getMessage(),
            ] );
        }
    }

    function upadateOrCreate( Request $request ) {
        try {
            $user_id = $request->header( 'id' );

            $name = $request->input( 'name' );
            $email = $request->input( 'email' );
            $father_name = $request->input( 'father_name' );
            $mother_name = $request->input( 'mother_name' );
            $date_of_birth = $request->input( 'date_of_birth' );
            $blood_group = $request->input( 'blood_group' );
            $Social_id = $request->input( 'Social_id' );
            $Passport_id = $request->input( 'Passport_id' );
            $cell_no = $request->input( 'cell_no' );
            $emergency_no = $request->input( 'emergency_no' );
            $linkedin = $request->input( 'linkedin' );
            $facebook = $request->input( 'facebook' );
            $github = $request->input( 'github' );
            $portfolio_link = $request->input( 'portfolio_link' );
            $image = $request->file( 'image' );

            $time = time();
            $image_name = $name . '_' . $time . $image->getClientOriginalExtension();
            $image->move( public_path( 'img/canidate' ), $image_name );
            $img_url = 'img/canidate/' . $image_name;

            $profile = Canidate::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'user_id'        => $user_id,
                    'name'           => $name,
                    'email'          => $email,
                    'father_name'    => $father_name,
                    'mother_name'    => $mother_name,
                    'date_of_birth'  => $date_of_birth,
                    'blood_group'    => $blood_group,
                    'Social_id'      => $Social_id,
                    'Passport_id'    => $Passport_id,
                    'cell_no'        => $cell_no,
                    'emergency_no'   => $emergency_no,
                    'linkedin'       => $linkedin,
                    'facebook'       => $facebook,
                    'github'         => $github,
                    'portfolio_link' => $portfolio_link,
                    'image'          => $img_url,
                ]
            );

            return response()->json( [
                'status'  => 'success',
                'message' => 'profile updated',
                'data'    => $profile,
            ] );
        } catch ( \Exception $ex ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $ex->getMessage(),
            ] );
        }
    }

    // createEducation
    public function createEducation( Request $request ) {
        try{
            $user_id = $request->header( 'id' );
            $canidate_id = Canidate::where( 'user_id', $user_id )->first()->id;
            $degree = $request->input( 'degree' );
            $institute = $request->input( 'institute' );
            $passing_year = $request->input( 'passing_year' );
            $department = $request->input( 'department' );
            $result = $request->input( 'result' );
            CanidateEdu::create([
                'canidate_id' => $canidate_id,
                'degree'      => $degree,
                'institute'   => $institute,
                'passing_year' => $passing_year,
                'department'  => $department,
                'result'      => $result
            ]);
            return response()->json( [
                'status' => 'success',
                'message' => 'education created successfully',
            ]);
        }catch(\Exception $ex){
            return response()->json( [
                'status'  => 'error',
                'message' => $ex->getMessage(),
            ] );
        }
    }

    // getEducation
    public function getEducation(Request $request){
        $user_id = $request->header('id');
        $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
        $edu = CanidateEdu::where('canidate_id', $canidate_id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $edu
        ]);
    }

    // destroy
    public function destroyedu( Request $request ) {
        $user_id = $request->header( 'id' );
        $id = $request->input( 'id' );
        $canidate_id = Canidate::where( 'user_id', $user_id )->first()->id;
        CanidateEdu::where( 'canidate_id', $canidate_id )->where( 'id', $id )->delete();
        return response()->json( [
            'status' => 'success',
            'message' => 'Education deleted successfully',
        ] );
    }

    // experiance
    public function createexp( Request $request ) {
        try{
            $user_id = $request->header('id');
            $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
            $company_name = $request->input('company_name');
            $position = $request->input('position');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            CanidateJobexperience::create([
                'canidate_id' => $canidate_id,
                'company_name' => $company_name,
                'position' => $position,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Experience created successfully',
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }


    public function getExperience(Request $request){
        $user_id = $request->header('id');
        $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
        $edu = CanidateJobexperience::where('canidate_id', $canidate_id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $edu
        ]);
    }

    // traning
    public function getTraning(Request $request){
        $user_id = $request->header('id');
        $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
        $tra = CanidateProTra::where('canidate_id', $canidate_id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $tra
        ]);
    }

    public function createTraning(Request $request){
        try{
            $user_id = $request->header('id');
            $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
            $training_name = $request->input('training_name');
            $institute = $request->input('institute');
            $end_date = $request->input('end_date');

            CanidateProTra::create([
                'canidate_id' => $canidate_id,
                'training_name' => $training_name,
                'institute' => $institute,
                'end_date' => $end_date
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Traning created successfully',
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }


    // skils

    public function getSkill(Request $request){
        $user_id = $request->header('id');
        $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
        $tra = Skil::where('canidate_id', $canidate_id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $tra
        ]);
    }

    public function createSkill(Request $request){
        try{
            $user_id = $request->header('id');
            $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
            $name = $request->input('name');
            $lavel = $request->input('level');

            Skil::create([
                'canidate_id' => $canidate_id,
                'name' => $name,
                'level' => $lavel
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Skill created successfully',
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function destroySkill( Request $request){
        $user_id = $request->header('id');
        $canidate_id = Canidate::where('user_id', $user_id)->first()->id;
        $id = $request->input('id');
        Skil::where('canidate_id', $canidate_id)->where('id', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Skill deleted successfully',
        ]);
    }



    // getCanidatesfor page
    public function getCanidates(){
        $canidates = Canidate::all();
        return response()->json([
            'status' => 'success',
            'data' => $canidates
        ]);
    }
}
