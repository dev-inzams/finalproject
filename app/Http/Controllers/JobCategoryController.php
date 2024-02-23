<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobCategoryController extends Controller {
    public function create( Request $request ) {
        try {
            $request->validate( [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
            ] );

            $title = $request->input( 'title' );
            $description = $request->input( 'description' );

            $img = $request->file('image');
            $time = time();
            $image_name =$title . '-' . $time . '.' . $img->getClientOriginalExtension();
            $img->move( public_path( 'img/job_category' ), $image_name );
            $image_url = 'img/job_category/' . $image_name;

            JobCategory::create([
                'title' => $title,
                'description' => $description,
                'image' => $image_url
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Job Category created successfully done'
            ]);

        } catch ( \Exception $e ) {
            return response()->json( [
                'status' => 'error',
                'message' => $e->getMessage(),
            ] );
        } // end try

    } // end create

    public function index() {
        try {
            $data = JobCategory::all();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status' => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function destroy( Request $request ) {
        try {
            $id = $request->input('id');
            $imgPath = JobCategory::where('id', $id)->value('image');
            File::delete( $imgPath );
            JobCategory::where('id', $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Job Category deleted successfully done'
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status' => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function update( Request $request ) {
        try {
            $id = $request->input('id');
            $title = $request->input('title');
            $description = $request->input('description');
            $image = $request->file('image');

            if( $image ) {
                $time = time();
                $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
                $image->move( public_path( 'img/job_category' ), $image_name );
                $image_url = 'img/job_category/' . $image_name;

                $imgPath = JobCategory::where('id', $id)->value('image');
                File::delete( $imgPath );

                JobCategory::where('id', $id)->update([
                    'title' => $title,
                    'description' => $description,
                    'image' => $image_url
                ]);
            } else {
                JobCategory::where('id', $id)->update([
                    'title' => $title,
                    'description' => $description
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Job Category updated successfully done'
            ]);

        }catch(\Exception $e) {
            return response()->json( [
                'status' => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }
}
