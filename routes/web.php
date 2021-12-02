<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Function_;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [HomeController::class, 'home'])->name('home');

//Route::view('/', 'home');

//whenever we ask for the /home path, we shoud run the "home" 
//that exists in the HomeController file

Route::view('/about','about')->name('about');


//to display a static view me only need to specify the route this way

Route::view('/static_view', 'static_view');


//create a route that runs a method, using a static segment(posts) 
//and two dynamic segments ({id and author})

Route::get('/dynamic_post/{id}/{author}', Function($id,$myAuthor){
    return $id . " author: $myAuthor";
} );


//Route::get('/posts/{id}/{author?}',[HomeController::class, 'blog']);

//we use 'only' if we only want to run some specific methods but not all of them
// Route::resource('/posts', PostController::class)
//         ->only(['index','show','create','store']);

/*
we use 'except' if want to use everything except the mentionned resource
Route::resource('/posts', PostController::class)
        ->except(['destroy']);
*/
Route::view('/', 'welcome');

Route::resource('/posts', PostController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
