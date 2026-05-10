<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Models\Category;
use App\Models\Post;

Route::get('/', function () {
   $posts= Post::latest()->take(4)->get();
   $categories= Category::withCount('posts')->latest()->get();
    return view('index',compact('posts','categories'));
});

Route::get('/admin_login', function () {
    return view('admin_login');
});

Route::get('/all_blogs', function () {
    return view('all_blogs');
})->middleware('admin');

Route::get('/add_blog', function () {
    return view('add_blog',['categories'=> Category::all()]);
})->middleware('admin');

Route::get('/blog-detail/{id}', function ($id) {
   $posts= Post::latest()->take(4)->get();
    $categories= Category::latest()->take(5)->get();
    return view('blog-detail',compact('id','posts','categories'));
})->name('blog-detail');

Route::post('/login', [MyController::class, 'processLogin'])->name('auth.processLogin');
Route::get('/get_blogs', [MyController::class, 'getBlogs'])->name('get_blogs');
Route::delete('/delete_post', [MyController::class, 'deletePost'])->name('delete_post');

Route::post('/blog/store', [MyController::class, 'store'])
    ->name('blog.store');

Route::get('/edit-blog/{id}', function ($id) {
    $categories=Category::all();
    return view('edit_blog',compact('id','categories'));
})->name('edit-blog');

Route::post('/blog/edit', [MyController::class, 'edit'])
    ->name('blog.edit')->middleware('admin');