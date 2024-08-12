<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\TagController;
use App\Http\Controllers\Auth\ProfileController;

use App\Http\Controllers\site\BlogController;
use App\Http\Controllers\site\CommentController;


// use App\Http\Requests\Auth\Poats\CreateRequest;

use App\Http\Requests\Auth\Site\CreateRequest;

Route::get('/logout', function () {
    auth()->logout();
    // return view('welcome');
});

// Route::view('/theme','auth.dashbord');

Auth::routes([
    // 'register'=>false
]);

Route::middleware('auth')->group(function(){

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashbord');

    Route::resource('auth/posts',PostController::class);
    Route::get('auth/categories',[CategoryController::class,'openCategoriesPage'])->name('auth.categories');
    Route::get('auth/tags',[TagController::class,'openTagsPage'])->name('auth.tags');
    Route::get('auth/profile',[ProfileController::class,'openProfilePage'])->name('auth.profile.index');
    Route::post('auth/profile',[ProfileController::class,'storeProfilePage'])->name('auth.profile.store');

});

//////////////////// MEGAKIT IMAGE PROJECT  ////////////////

// Route::view('/','site.index');

Route::get('/',[BlogController::class,'index'])->name('home');

Route::get('/single-blog/{id}',[BlogController::class,'openSingleBlog'])->name('single-blog');

Route::post('post/comment/{postId}',[CommentController::class,'postComment'])->name('post.comment')->middleware('auth');
Route::post('comment/reply/{commentId}',[CommentController::class,'postCommentReply'])->name('comment.reply');
Route::delete('comment/reply/dalete',[CommentController::class,'deleteCommentReply'])->name('comment.reply.delete');
