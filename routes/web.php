<?php

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
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
use App\Http\Controllers\JobApplyController;
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
    Route::get('/jobplus/dashboard',[Controller::class,'emOrca'])->name('dashboard');
    // employee pages route
    Route::middleware([EmployeeMiddleware::class])->group(function(){
       Route::view('/jobplus/company','employee.pages.company')->name('employee-company');
       Route::view('/jobplus/create-company','employee.pages.companyCreate')->name('employee-companyCreate');
       Route::view('/jobplus/jobs','employee.pages.jobs')->name('employee-jobs');
       Route::view('/jobplus/profile','employee.pages.profile')->name('employee-profile');
    });

    // canidate
    Route::middleware([CanidateMiddleare::class])->group(function(){
        Route::view('/jobplus/candidate-profile','canidate.pages.profile')->name('canidate-profile');
        Route::view('/jobplus/candidate-education','canidate.pages.education')->name('canidate-education');
        Route::view('/jobplus/candidate-experience','canidate.pages.experience')->name('canidate-experience');
        Route::view('/jobplus/candidate-traning','canidate.pages.traning')->name('canidate-traning');
        Route::view('/jobplus/candidate-skils','canidate.pages.skil')->name('canidate-skils');
        Route::view('/jobplus/candidate-jobs-apply','canidate.pages.jobs')->name('canidate-jobs');
    });

    // admin
    Route::middleware([AdminMiddleware::class])->group(function(){
        Route::view('/jobplus/admin-profile','admin.pages.profile')->name('admin-profile');
        Route::view('/jobplus/admin-jobs-control','admin.pages.jobs-control')->name('admin-jobs-control');
        Route::view('/jobplus/admin-posts-control','admin.pages.posts-control')->name('admin-posts-control');
        Route::view('/jobplus/admin-categories-control','admin.pages.categories-control')->name('admin-categories-control');
    });
});



//without auth page
Route::view('/','indexing.pages.index')->name('index');
Route::view('/login','auth.pages.login')->name('login');
Route::view('/registration','auth.pages.registration')->name('registration');
Route::get('/canidate-profile/{id}',[Controller::class,'canidateProfile']);














// all is api route


// category
Route::post('/get-categories',[CategoryController::class,'index']);
Route::post('/user-delete-category',[CategoryController::class,'destroy']);
Route::post('/user-update-category',[CategoryController::class,'update']);
Route::post('/user-get-category',[CategoryController::class,'getCategory']);
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
Route::post('/publish-job',[JobController::class,'publish']);
Route::post('/user-total-jobs',[JobController::class,'totaljobs']);
Route::post('/user-view-jobs',[JobController::class,'viewjobs']);
// pages get all api
Route::post('/get-jobs',[JobController::class,'index']);
Route::get('/get-job/{id}',[JobController::class,'show']);

Route::post('/get-canidates',[CanidateController::class,'getCanidates']);
Route::post('/get-jobs-category',[JobCategoryController::class,'getjobsCategory']);

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
        Route::post('/view-job-applicants',[JobController::class,'getapplicants']);
        Route::post('/destroy-jobs',[JobController::class,'destroy'])->name('destroy-jobs');
        Route::post('/selected-canidate',[JobApplyController::class,'selected']);
        // employee profile
        Route::post('/employer-get-profile',[EmployeeController::class,'index']);
        Route::post('/getuserdetails',[TopBarController::class,'index']);
        Route::post('/employer-update-profile',[EmployeeController::class,'update']);
        Route::post('/employee-all-details',[EmployeeController::class,'details'])->name('jobs');
    });

    Route::middleware([CanidateMiddleare::class])->group(function(){
        Route::post('/candidate-get-profile',[CanidateController::class,'index']);
        Route::post('/candidate-updateOrCreate-profile',[CanidateController::class,'upadateOrCreate']);
        Route::post('/canidate-get-education',[CanidateController::class,'getEducation']);
        Route::post('/canidate-create-education',[CanidateController::class,'createEducation']);
        Route::post('/canidate-destroy-education',[CanidateController::class,'destroyedu']);

        Route::post('/canidate-create-experience',[CanidateController::class,'createexp']);
        Route::post('/canidate-get-experience',[CanidateController::class,'getExperience']);

        Route::post('/canidate-get-traning',[CanidateController::class,'getTraning']);
        Route::post('/canidate-create-traning',[CanidateController::class,'createTraning']);

        Route::post('/canidate-get-skil',[CanidateController::class,'getSkill']);
        Route::post('/canidate-create-skil',[CanidateController::class,'createSkill']);
        Route::post('/canidate-delete-skil',[CanidateController::class,'destroySkill']);
        Route::post('/apply-for-job',[JobApplyController::class,'applyForJob']);
        Route::post('/canidate-get-applyed-jobs',[JobApplyController::class,'getAppliedJobs']);
    });

    Route::post('/update-jobs',[JobController::class,'update'])->name('update-jobs');

    // category route api
    Route::post('/create-category', [CategoryController::class, 'create']);

    Route::middleware([AdminMiddleware::class])->group(function(){
        Route::post('/admin-delete-jobs', [JobController::class, 'adminDestroy']);
    });
});
