<?php

namespace App\Http\Controllers;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller {

    public function index( Request $request ) {
        $user_id = $request->header('id');
        $user = User::where('id', $user_id )->first();
        $employee = Employee::where('user_id', $user->id)->first();
        if($employee){
            return response()->json([
                'status' => 'success',
                'user'  => $user,
                'employee' => $employee
            ],200);
        }else{
            return response()->json([
                'status' => 'error',
                'user'  => $user
            ],200);
        }
    }

    // update
    public function update( Request $request ) {
        try{
            $user_id = $request->header('id');
            $user = User::where('id', $user_id )->first();
            $employee = Employee::where('user_id', $user->id)->first();
            if($employee){
                $employee->update($request->all());
                return response()->json([
                    'status' => 'success',
                    'message' => 'profile updated successfully'
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // details for dashboard
    public function details( Request $request ) {
        $user_id = $request->header('id');
        $user = User::where('id', $user_id )->first();
        $employee = Employee::where('user_id', $user->id)->first();
        $company = Company::where('employee_id', $employee->id)->first();
        $total_jobs = Job::where('company_id', $company->id)->count();
        return response()->json([
            'status' => 'success',
            'company' => $company,
            'employee' => $employee,
            'user'  => $user,
            'total_jobs' => $total_jobs
        ],200);
    }
}
