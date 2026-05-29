<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\CurrencyController;

// Logged in Routes
 Route::get('/auth/profile',      [AuthController::class, 'showProfile'])->middleware('jwt.auth1');


// Admin Routes
Route::middleware('admin.auth')->group(function () {
Route::get('/dashboard', function () {
    return view('all_blogs');
});
Route::get('/all_comments', function () {
    return view('all_comments');
});

Route::get('/add_blog', function () {
    return view('add_blog',['categories'=> Category::all()]);
});

Route::get('/edit-blog/{id}', function ($id) {
    $categories=Category::all();
    return view('edit_blog',compact('id','categories'));
})->name('edit-blog');
});


// Public Routes

Route::get('/', function () {
   $posts= Post::latest()->take(4)->get();
   $categories= Category::withCount('posts')->latest()->get();
    return view('index',compact('posts','categories'));
})->name('/');

Route::prefix('auth')->group(function () {
     Route::get('register', [AuthController::class, 'showRegister']);
    Route::get('login',    [AuthController::class, 'showLogin'])->name('login');

     Route::post('register', [AuthController::class, 'register'])->name('register.store');
    Route::post('login',    [AuthController::class, 'login'])->name('login.store');
});


Route::get('/admin_login', function () {
    return view('admin_login');
})->name('admin_login');

Route::post('/admin_login', [MyController::class, 'processLogin'])->name('auth.processLogin');

Route::get('/blog-detail/{id}', function ($id) {
   $posts= Post::latest()->take(4)->get();
    $categories= Category::latest()->take(5)->get();
    return view('blog-detail',compact('id','posts','categories'));
})->name('blog-detail');

Route::get('/get_blogs', [MyController::class, 'getBlogs'])->name('get_blogs');

Route::get('get_comments', [CommentController::class, 'getAllComments'])->name('get_comments');

Route::get('/currency', [CurrencyController::class, 'index']);
Route::post('/currency/convert', [CurrencyController::class, 'convert']);
