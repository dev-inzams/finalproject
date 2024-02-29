<?php

namespace App\Http\Controllers;

use App\Models\Canidate;
use App\Models\CanidateEdu;
use App\Models\CanidateProTra;
use App\Models\Skil;
use Illuminate\Http\Request;
use App\Models\CanidateJobexperience;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {
    use AuthorizesRequests, ValidatesRequests;

    public function emOrca( Request $request ) {
       $type = $request->header('type' );
       if( $type == 'employee' ) {
           return view('employee.pages.dashboard');
       } else if( $type == 'canidate' ) {
           return view('canidate.pages.dashboard');
       }else{
           return view('admin.pages.dashboard');
       }
    }

    public function canidateProfile( Request $request ) {
        try{
            $user_id = $request->id;
            $profile = Canidate::where( 'id', $user_id )->first();
            $canidate_edu = CanidateEdu::where( 'canidate_id', $profile->id )->get();
            $jobExo = CanidateJobexperience::where( 'canidate_id', $profile->id )->get();
            $traning = CanidateProTra::where( 'canidate_id', $profile->id )->get();
            $skils = Skil::where( 'canidate_id', $profile->id )->get();
            return view( 'indexing.pages.canidate-profile', [
                'profile'       => $profile,
                'canidate_edu'  => $canidate_edu,
                'jobExp'        => $jobExo,
                'traning'       => $traning,
                'skils'         => $skils
            ] );
        }catch( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
