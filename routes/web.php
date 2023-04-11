<?php

use App\Http\Controllers\DashboardCategoriesController;
use App\Http\Controllers\DashboardPostsController;
use App\Http\Controllers\PostModelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view("home",[
        "title" => "Home"
    ]);
});

Route::get('/about', function() {
    return view("about", [
        "title" => "About",
        "name" => "Laskar Jihad",
        "email" => "laskar@gmail.com",
        "image"=> "ai.jpg"
    ]);
});

Route::get('/posts', [PostModelController::class, "index"]);
Route::get('/posts/{post:slug}', [PostModelController::class, "singlePost"]);


//Category  
Route::get('/categories', function(){
    return view("categories", [
        "title" => "Categoies",
        "categories" => Category::all()
    ]);
});
// Route::get('/category/{category:slug}', function(Category $category){
//     return view("posts", [
//         "title" => "All Posts in ". $category->name,
//         "posts" => $category->posts->load('user', 'category')
//     ]);
// });

// //User
// Route::get('/user/{user:username}', function(User $user){
//     return view('posts', [
//         "title" => "All Posts by ". $user->name,
//         "posts" => $user->posts->load('user', 'category')
//     ]);
// });


// Login and Registration
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');


// Dashboard
Route::get('/dashboard', function(){
    return view('dashboard.index', [
        "title" => "Dashboard"
    ]);
});

// Dashboard Posts
Route::resource('/dashboard/posts', DashboardPostsController::class);

//Route::get('/dashboard/posts/create', 'DashboardPostsController@Show')->name('posts.show')->middleware('auth');
// Route::get('/dashboard/posts/{slug}', 'DashboardPostsController@Create')->name('posts.create')->middleware('auth');
Route::put('/dashboard/posts', 'DashboardPostsController@Store')->name('posts.store')->middleware('auth');
Route::get('/dashboard/posts/{slug}/edit', 'DashboardPostsController@Edit')->name('posts.edit')->middleware('auth');
Route::delete('/dashboard/posts/{slug}', 'DashboardPostsController@Delete')->name('posts.delete')->middleware('auth');
Route::post('/dashboard/posts/{slug}', 'DashboardPostsController@Update')->name('posts.update')->middleware('auth');

// Dashboard CategoriesPP
Route::resource('dashboard/categories', DashboardCategoriesController::class)->middleware('admin');

