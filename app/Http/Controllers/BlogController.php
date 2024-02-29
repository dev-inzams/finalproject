<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class BlogController extends Controller {

    // create
    public function create( Request $request ) {
        try {
            $request->validate( [
                'category_id' => 'required',
                'title'       => 'required',
                'short_des'   => 'required',
                'image'       => 'required',
                'description' => 'required',
            ] );
            $title = $request->input( 'title' );
            $short_des = $request->input( 'short_des' );
            $description = $request->input( 'description' );
            $category_id = $request->input( 'category_id' );
            $image = $request->file( 'image' );
            $time = time();
            $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
            $image->move( public_path( 'img/blogs' ), $image_name );
            $image_url = 'img/blogs/' . $image_name;
            Blog::create( [
                'category_id' => $category_id,
                'title'       => $title,
                'short_des'   => $short_des,
                'description' => $description,
                'image'       => $image_url
            ]);
            return response()->json( [
                'status'  => 'success',
                'message' => 'Blog created successfully!',
            ]);
        } catch ( \Exception $e ) {
            return response()->json( [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ] );
        }
    }

    public function index() {
        $blogs = Blog::all();
        return response()->json( ['data' => $blogs] );
    }

    public function destroy( Request $request ) {
        $id = $request->input( 'id' );
        $imgPath = Blog::where ( 'id', $id )->value('image');
        File::delete( $imgPath );
        $blog = Blog::find( $id );
        $blog->delete();
        return response()->json( [
            'status'  => 'success',
            'message' => 'Blog deleted successfully!',
        ] );
    }

    public function update( Request $request ) {
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $short_des = $request->input('short_des');
            $description = $request->input('description');
            $category_id = $request->input('category_id');
            $image = $request->file('image');
            if($image){
                $imgPath = Blog::where('id', $id)->value('image');
                File::delete($imgPath);
                $time = time();
                $image_name = $title . '-' . $time . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/blogs'), $image_name);
                $image_url = 'img/blogs' . $image_name;
                $blog = Blog::find($id);
                $blog->update([
                    'category_id' => $category_id,
                    'title' => $title,
                    'short_des' => $short_des,
                    'description' => $description,
                    'image' => $image_url
                ]);
            }else{
                $blog = Blog::find($id);
                $blog->update([
                    'category_id' => $category_id,
                    'title' => $title,
                    'short_des' => $short_des,
                    'description' => $description,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Blog updated successfully!',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
