<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller {

    // create a new company
    public function create( Request $request ) {
        try{
            $request->validate([
                'Company_name' => 'required',
                'Company_email' => 'required',
                'Company_address' => 'required',
                'Company_phone' => 'required',
                'Company_website' => 'required',
            ]);

            $Company_name = $request->input('Company_name');
            $Company_email = $request->input('Company_email');
            $Company_address = $request->input('Company_address');
            $Company_phone = $request->input('Company_phone');
            $Company_website = $request->input('Company_website');
            $img = $request->file('Company_logo');
            $time = time();
            $image_name = $time . '.'. $img->getClientOriginalExtension();
            $img->move(public_path('img/company_logo'), $image_name);

            $company_logo = 'img/company_logo/' . $image_name;

            $user_id = $request->header('id');
            $employer_id = Employee::where('user_id', $user_id)->first()->id;
            $check = Company::where('employee_id', $employer_id)->first();
            if ($check) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Company already exists'
                ]);
            }
            Company::create([
                'employee_id' => $employer_id,
                'Company_name' => $Company_name,
                'Company_email' => $Company_email,
                'Company_address' => $Company_address,
                'Company_phone' => $Company_phone,
                'Company_website' => $Company_website,
                'Company_logo' => $company_logo
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Company created successfully'
            ]);

        }catch( \Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function index( Request $request ){
        $user_id = $request->header('id');
        $employer_id = Employee::where('user_id', $user_id)->first()->id;
        $companies = Company::where('employee_id', $employer_id)->get();
        return response()->json(['data' =>$companies]);
    }

    public function update( Request $request ){
        try{
            $Company_name = $request->input('Company_name');
            $Company_email = $request->input('Company_email');
            $Company_address = $request->input('Company_address');
            $Company_phone = $request->input('Company_phone');
            $Company_website = $request->input('Company_website');
            $img = $request->file('Company_logo');
            $user_id = $request->header('id');
            $employer_id = Employee::where('user_id', $user_id)->first()->id;
            if($img){
                $imgPath = Company::where('employee_id',$employer_id)->value('Company_logo');
                File::delete($imgPath);
                $time = time();
                $image_name = $time . '.'. $img->getClientOriginalExtension();
                $img->move(public_path('img/company_logo'), $image_name);
                $img_url = 'img/company_logo/' . $image_name;
                Company::where('employee_id', $employer_id)->update([
                    'Company_name' => $Company_name,
                    'Company_email' => $Company_email,
                    'Company_address' => $Company_address,
                    'Company_phone' => $Company_phone,
                    'Company_website' => $Company_website,
                    'Company_logo' => $img_url
                ]);
            }else{
                Company::where('employee_id', $employer_id)->update([
                    'Company_name' => $Company_name,
                    'Company_email' => $Company_email,
                    'Company_address' => $Company_address,
                    'Company_phone' => $Company_phone,
                    'Company_website' => $Company_website,
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Company updated successfully'
            ]);
        }catch( \Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
