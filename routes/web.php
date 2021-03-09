<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogsController;
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

//dashboard

//logout
Route::get('/logout', 'LogoutController@logout')->name('logout');

//register
Route::get('/register', 'RegisterController@ShowRegister');

Route::post('/register', 'RegisterController@DoRegister')->name('register');

// //login
// Route::get('/login', 'LoginController@ShowLogin');

// Route::post('/login', 'LoginController@DoLogin')->name('login');

Route::any('login', 'AuthController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('content.dashboard');
    })->name('dashboard');
    
    
    //blogs
    Route::get('/blogs', 'BlogsController@ShowAllBlogs')->name('blogs');
    
    
    Route::get('/blogs/{id}', 'BlogsController@ShowBlog');
    
    //portfolio
    Route::get('/portfolio', function () {
        return view('content.portfolio');
    })->name('portfolio');
    
    Route::get('/profile', function () {
        echo "hello";
    })->name('profile');
    
});

//site
Route::get('/', function () {
    return view('welcome');
});
