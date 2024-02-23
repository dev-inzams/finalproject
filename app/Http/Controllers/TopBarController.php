<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class TopBarController extends Controller {
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
}
