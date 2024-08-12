<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::where('status',Post::PUBLISHED)->paginate(2);
        return view('site.index',compact('blogs'));
    }

    public function openSingleBlog($id)
    {
        $blog = Post::find($id);

        if(! $blog){
            abort(404);
        }
        $comments = Comment::where('post_id',$blog->id)->paginate(1);
        $latestPosts = Post::latest()->limit(5)->get();
        $tags = $blog->tags;

        return view('site.single',compact('blog','comments','latestPosts','tags'));
    }
}
