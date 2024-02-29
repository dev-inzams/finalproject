<?php

namespace App\Http\Controllers;

use App\Models\Canidate;
use App\Models\Job;
use App\Models\JobApply;
use Illuminate\Http\Request;

class JobApplyController extends Controller
{
    public function applyForJob( Request $request ) {
        try {
            $request->validate( [
                'job_id' => 'required',
                'company_id' => 'required',
            ] );
            $user_id = $request->header( 'id' );
            $canidate_id = Canidate::where( 'user_id', $user_id )->first()->id;
            $job_id = $request->input( 'job_id' );
            $company_id  = $request->input( 'company_id' );
            $description = $request->input( 'description' );
            $price = $request->input( 'price' );

            JobApply::create( [
                'job_id' => $job_id,
                'company_id' => $company_id,
                'canidate_id' => $canidate_id,
                'description' => $description,
                'price' => $price,
            ] );
            return response()->json( [
                'status'  => 'success',
                'message' => 'Job applied successfully',
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function getAppliedJobs( Request $request ) {
        try {
            $user_id = $request->header( 'id' );
            $canidate_id = Canidate::where( 'user_id', $user_id )->first()->id;
            $jobs = JobApply::where( 'canidate_id', $canidate_id )->get();

            return response()->json( [
                'status'  => 'success',
                'data'    => $jobs
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function selected( Request $request){
        $job_id = $request->input( 'job_id' );
        $canidate_id = $request->input( 'canidate_id' );
        JobApply::where( 'job_id', $job_id )->where( 'canidate_id', $canidate_id )->update([
            'status' => 'selected'
        ]);
        return response()->json( [
            'status'  => 'success',
            'message' => 'Job selected successfully'
        ]);
    }
}
