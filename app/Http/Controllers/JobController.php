<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobController extends Controller {
    public function create( Request $request ) {
        try {
            $request->validate( [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
                'skills' => 'required',
                'type' => 'required',
                'salary' => 'required',
                'expire' => 'required',
            ] );
            $category_id = $request->input( 'category_id' );
            $title = $request->input( 'title' );
            $description = $request->input( 'description' );
            $image = $request->file( 'image' );
            $skills = $request->input( 'skills' );
            $type = $request->input( 'type' );
            $salary = $request->input( 'salary' );
            $expire = $request->input( 'expire' );

            $time = time();
            $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
            $image->move( public_path( 'img/jobs' ), $image_name );

            $img_url = 'img/jobs/' . $image_name;

            $user_id = $request->header('id');
            $employer_id = Employee::where('user_id', $user_id)->first()->id;
            $company_id = Company::where('employee_id', $employer_id)->first()->id;

            Job::create([
                'company_id' => $company_id,
                'category_id' => $category_id,
                'title' => $title,
                'description' => $description,
                'image' => $img_url,
                'skills' => $skills,
                'type' => $type,
                'salary' => $salary,
                'expire' => $expire,
            ]);

            return response()->json( [
                'status'  => 'success',
                'message' => 'Job created successfully',
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function index( Request $request ) {
        try {
            $jobs = Job::all();
            if($jobs){
                return response()->json( [
                    'status'  => 'success',
                    'data'    => $jobs
                ]);
            }else{
                return response()->json( [
                    'status'  => 'error',
                    'data' => 'No jobs found',
                ]);
            }

        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function update( Request $request ) {
        try {
            $user_id = $request->header('id');
            $employer_id = Employee::where('user_id', $user_id)->first()->id;
            $company_id = Company::where('employee_id', $employer_id)->first()->id;
            $category_id = $request->input( 'category_id' );
            $id = $request->input( 'id' );
            $title = $request->input( 'title' );
            $description = $request->input( 'description' );
            $image = $request->file( 'image' );
            $skills = $request->input( 'skills' );
            $type = $request->input( 'type' );
            $salary = $request->input( 'salary' );
            $expire = $request->input( 'expire' );
            if( $image ) {
                $imgPath = Job::where('id', $id)->where('company_id', $company_id)->value('image');
                File::delete( $imgPath );
                $time = time();
                $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
                $image->move( public_path( 'img/jobs' ), $image_name );
                $img_url = 'img/jobs/' . $image_name;
                Job::where('id', $id)->where('company_id', $company_id)->update([
                    'category_id' => $category_id,
                    'title' => $title,
                    'description' => $description,
                    'image' => $img_url,
                    'skills' => $skills,
                    'type' => $type,
                    'salary' => $salary,
                    'expire' => $expire,
                ]);

            } else {
                Job::where('id', $id)->where('company_id', $company_id)->update([
                    'category_id' => $category_id,
                    'title' => $title,
                    'description' => $description,
                    'skills' => $skills,
                    'type' => $type,
                    'salary' => $salary,
                    'expire' => $expire,
                ]);
            }
            return response()->json( [
                'status'  => 'success',
                'message' => 'Job updated successfully',
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function destroy( Request $request ) {
        try {
            $user_id = $request->header('id');
            $employer_id = Employee::where('user_id', $user_id)->first()->id;
            $company_id = Company::where('employee_id', $employer_id)->first()->id;
            $id = $request->input( 'id' );
            $imgPath = Job::where('id', $id)->where('company_id', $company_id)->value('image');
            File::delete( $imgPath );
            Job::where('id', $id)->where('company_id', $company_id)->delete();
            return response()->json( [
                'status'  => 'success',
                'message' => 'Job deleted successfully',
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function getcompnayjobs( Request $request ) {
        $user_id = $request->header('id');
        $employer_id = Employee::where('user_id', $user_id)->first()->id;
        $company_id = Company::where('employee_id', $employer_id)->first()->id;
        $jobs = Job::where('company_id', $company_id)->get();
        if($jobs){
            return response()->json( [
                'status'  => 'success',
                'data'    => $jobs
            ]);
        }else{
            return response()->json( [
                'status'  => 'error',
                'message' => 'No jobs found',
            ]);
        }
    }
}
