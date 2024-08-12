<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Comments\CreateRequest;
use App\Http\Requests\Site\Comments\Reply\CreateRequest as ReplyCreateRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentReply;

class CommentController extends Controller
{
    public function postComment(CreateRequest $request, $postId)
    {
        if(auth()->check())
        {
            $post = Post::find($postId);

            if(! $post){
                return back()->WithErrors('Unable to find the post, Please refresh the webpage and try again.');
            }

            Comment::create([
                'post_id'=>$postId,
                'user_id'=>auth()->id(),
                'comment'=>$request->comment
            ]);
            $request->session()->flash('alert-success',' Comment added successfully');
        }
        return back();
    }

    public function postCommentReply(ReplyCreateRequest $request ,$commentId)
    {
        $commentId = $commentId;
        $comment = $request->comment;

        try {
            CommentReply::create([
                'comment_id'=>$commentId,
                'user_id'=>auth()->id(),
                'comment'=>$comment
            ]);
        }
        catch(\Exception $ex){
            return back()->withErrors($ex->getMessage());
        }
        $request->session()->flash('alert-success',' Comment reply added successfully');

        return back();
    }

    public function deleteCommentReply(Request $request)
    {
        $replyId = $request->reply_id;

        $reply = CommentReply::find($replyId);

        if(! $reply){
            return back()->withErrors('Unable to locate to reply');
        }
        $reply->delete();
        $request->session()->flash('alert-success',' Comment reply delete successfully');

        return back();
    }
}
