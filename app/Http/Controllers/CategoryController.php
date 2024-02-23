<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller {


    public function create( Request $request ) {
        try {
            $request->validate( [
                'title' => 'required',
                'description' => 'required',
            ] );
            $title = $request->input( 'title' );
            $description = $request->input( 'description' );
            $image = $request->file( 'image' );
            $time = time();
            $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
            $image->move( public_path( 'img/categories' ), $image_name );
            $img_url = 'img/categories/' . $image_name;

            $user_id = $request->header('id');

            Category::create( [
                'title' => $title,
                'description' => $description,
                'image' => $img_url,
                'user_id' => $user_id,
            ]);

            return response()->json( [
                'status'  => 'success',
                'message' => 'Category created successfully',
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function index() {
        $categories = Category::all();
        return response()->json( [
            'categories' => $categories,
        ] );
    }

    public function destroy( Request $request ) {
        $id = $request->input( 'id' );
        $imgPath = Category::where('id', $id)->value('image');
        File::delete($imgPath);

        $category = Category::find( $id );
        $category->delete();
        return response()->json( [
            'status'  => 'success',
            'message' => 'Category deleted successfully',
        ] );
    }

    public function update( Request $request ) {
        try{
            $id = $request->input( 'id' );
            $title = $request->input( 'title' );
            $description = $request->input( 'description' );
            $image = $request->file( 'image' );
            if($image){
                $imgPath = Category::where('id', $id)->value('image');
                File::delete($imgPath);

                $time = time();
                $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
                $image->move( public_path( 'img/categories' ), $image_name );
                $img_url = 'img/categories/' . $image_name;
                Category::where('id', $id)->update( [
                    'title' => $title,
                    'description' => $description,
                    'image' => $img_url,
                ]);

            }else{
                Category::where('id', $id)->update( [
                    'title' => $title,
                    'description' => $description,
                ]);
            }
            return response()->json( [
                'status'  => 'success',
                'message' => 'Category updated successfully',
            ] );
        }catch(\Exception $e){
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }
}
