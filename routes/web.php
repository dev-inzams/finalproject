<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenMiddleware;
use App\Http\Controllers\TopBarController;
use App\Http\Middleware\CanidateMiddleare;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Controllers\CanidateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//pages route


Route::middleware([TokenMiddleware::class])->group(function(){
    // employee pages route
    Route::middleware([EmployeeMiddleware::class])->group(function(){
       Route::view('/jobplus/employee','employee.pages.dashboard')->name('employee-dashboard');
       Route::view('/jobplus/company','employee.pages.company')->name('employee-company');
       Route::view('/jobplus/create-company','employee.pages.companyCreate')->name('employee-companyCreate');
       Route::view('/jobplus/jobs','employee.pages.jobs')->name('employee-jobs');
       Route::view('/jobplus/profile','employee.pages.profile')->name('employee-profile');
    });

    // canidate
    Route::middleware([CanidateMiddleare::class])->group(function(){
        Route::view('/jobplus/candidate','canidate.pages.dashboard')->name('canidate-dashboard');
        Route::view('/jobplus/candidate-profile','canidate.pages.profile')->name('canidate-profile');
        Route::view('/jobplus/candidate-education','canidate.pages.education')->name('canidate-education');
    });
});


// dashboard page route
    // admin
Route::view('/jobplus/admin','admin.pages.dashboard')->name('home');

    // employee


    // canidate
Route::view('/jobplus/canidate','canidate.pages.dashboard')->name('home');


// auth page
Route::view('/login','auth.pages.login')->name('login');
Route::view('/registration','auth.pages.registration')->name('login');














// all is api route


// category
Route::post('/get-categories',[CategoryController::class,'index']);
Route::post('/user-delete-category',[CategoryController::class,'destroy']);
Route::post('/user-update-category',[CategoryController::class,'update']);

// blogs api
Route::post('/user-create-blog',[BlogController::class,'create']);
Route::post('/user-get-blogs',[BlogController::class,'index']);
Route::post('/user-delete-blog',[BlogController::class,'destroy']);
Route::post('/user-update-blog',[BlogController::class,'update']);

// jobs related api
Route::post('/create-job-category',[JobCategoryController::class, 'create']);
Route::post('/get-jobs-category',[JobCategoryController::class,'index']);
Route::post('/user-delete-job-category',[JobCategoryController::class,'destroy']);
Route::post('/user-update-job-category',[JobCategoryController::class,'update']);

// get all jobs
Route::post('/get-jobs',[JobController::class,'index']);



// auth api route
Route::post('/user-registration',[UserController::class,'userRegistration'])->name('user-registration');
Route::post('/user-login',[UserController::class,'userLogin'])->name('user-login');
Route::get('/user-logout',[UserController::class,'UserLogout'])->name('logout');
Route::post('/user-send-otp',[UserController::class,'SendOTPCode'])->name('user-send-otp');
Route::post('/user-verify-otp',[UserController::class,'VerifyOTPCode'])->name('user-verify-otp');
Route::post('/user-reset-password',[UserController::class,'ResetPassword'])->middleware([TokenMiddleware::class]);


// group route for token verification middleware
Route::middleware([TokenMiddleware::class])->group(function(){
    Route::middleware([EmployeeMiddleware::class])->group(function(){
        Route::post('/employer-company-registration',[CompanyController::class,'create']);
        Route::post('/get-company',[CompanyController::class,'index']);
        Route::post('/user-update-company',[CompanyController::class,'update']);

        Route::post('/create-jobs',[JobController::class,'create'])->name('create-jobs');
        Route::post('/user-get-jobs',[JobController::class,'getcompnayjobs']);
        Route::post('/destroy-jobs',[JobController::class,'destroy'])->name('destroy-jobs');

        // employee profile
        Route::post('/employer-get-profile',[EmployeeController::class,'index']);
        Route::post('/getuserdetails',[TopBarController::class,'index']);
        Route::post('/employer-update-profile',[EmployeeController::class,'update']);
        Route::post('/employee-all-details',[EmployeeController::class,'details']);
    });

    Route::middleware([CanidateMiddleare::class])->group(function(){
        Route::post('/candidate-get-profile',[CanidateController::class,'index']);
        Route::post('/candidate-updateOrCreate-profile',[CanidateController::class,'upadateOrCreate']);
    });

    Route::post('/update-jobs',[JobController::class,'update'])->name('update-jobs');

    // category route api
    Route::post('/create-category', [CategoryController::class, 'create']);
});
