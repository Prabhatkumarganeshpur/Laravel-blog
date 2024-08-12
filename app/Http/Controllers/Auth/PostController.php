<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Posts\CreateRequest;
use App\Http\Requests\Auth\Posts\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\galleries;
use Illuminate\Support\Facades\DB;

class PostController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {

        $posts = Post::all();
        return view( 'auth.posts.index', compact( 'posts' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {

        $categories = Category::all();
        $tags = Tag::all();
        return view( 'auth.posts.create' )->with( 'categories', $categories )
        ->with( 'tags', $tags );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( CreateRequest $request ) {

        try {
            DB::beginTransaction();

            if ( $file = $request->file( 'file' ) ) {

                $fileName = $this->uploadFile( $file );

                $gallery = $this->storeImage($fileName);
            }

            $post = Post::create( [
                'gallery_id'=> $gallery->id,
                'user_id'=>auth()->id(),
                'title'=>$request->title,
                'description'=>$request->description,
                'status'=>$request->status,
                'category_id'=>$request->category,
            ] );

            foreach ( $request->tags as $tag ) {
                $post->tags()->attach( $tag );
            }
            DB::commit();

            $request->session()->flash( 'alert-success', 'Post Created Successfully' );

            return to_route( 'posts.index' );
        } catch( \Exception $ex ) {
            DB::rollBack();
            return back()->withErrors( $ex->getMessage() );
        }
        return 'done';
    }

    /**
    * Display the specified resource.
    */

    public function show( Post $post ) {
        return view( 'auth.posts.show', compact( 'post' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $post = Post::find( $id );
        $categories = Category::all();
        $tags = Tag::all();

        return view( 'auth.posts.edit', compact( 'post', 'categories', 'tags' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( UpdateRequest $request, Post $post ) {

        if( $file = $request->file('file'))
        {
            $imageName = null;
            if($post->gallery){

                $imageName = $post->gallery->image;

                $imagePath = public_path('storage/auth/posts/');
                if(file_exists($imageName)){
                    unlink($imagePath,$imageName);
                }
            }
           
            $fileName = $this->uploadFile($file);

            $post->gallery->update([
                'image' => $fileName
            ]);
        }

        $post->update([
            'user_id'=>auth()->id(),
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'category_id'=>$request->category,
        ]);

        foreach ( $request->tags as $tag ) {
            $post->tags()->attach( $tag );
        }

        $request->session()->flash( 'alert-success', 'Post Update Successfully' );

        return to_route( 'posts.index' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Post $post ) {

        $post->tags()->detach();
        $post->delete();

        request()->session()->flash( 'alert-success', 'Post Delete Successfully' );

        return to_route( 'posts.index' );
    }

    private function uploadFile( $file ) {
        $fileName = rand( 100, 1000 ).time().$file->getClientOriginalName();

        $filePath = public_path( '/storage/auth/posts/' );

        $file->move( $filePath, $fileName );

        // $gallery = $this->storeImage( $fileName );
         return $fileName;
    }

    private function storeImage( $fileName ) {
        $gallery = galleries::create( [
            'image' => $fileName,
            'type' => galleries::POST_IMAGE
        ] );

        return $gallery;
    }
}
