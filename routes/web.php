<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\SiteController;
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





Route::group(['middleware' => ['auth']], function(){
    //dashboard
    Route::get('/dashboard', function () {
        return view('content.dashboard');
    })->name('dashboard');
    //blogs
    Route::get('/blogs', 'BlogsController@ShowAllBlogs')->name('blogs');

    Route::get('/blogs/{id}', 'BlogsController@ShowBlog');

    Route::get('/new-blog', 'BlogsController@ShowNewBlog');
    
    Route::post('/new-blog', 'BlogsController@AddNewBlog')->name('addblog');

    Route::post('/blogs', 'BlogsController@UpdateBlog')->name('updateblog');

    Route::get('/remove-blog/{id}', 'BlogsController@RemoveBlog')->name('removeblog');

    //portfolio
    Route::get('/portfolio', function () {
        return view('content.portfolio');
    })->name('portfolio');

    Route::get('/profile', function () {
        echo "hello";
    })->name('profile');
});

//logout
Route::get('/logout', 'LogoutController@logout')->name('logout');

//register
Route::get('/register', 'RegisterController@ShowRegister');

Route::post('/register', 'RegisterController@DoRegister')->name('register');

//login
Route::get('/login', 'LoginController@ShowLogin');

Route::post('/login', 'LoginController@DoLogin')->name('login');


//site
Route::get('/', "SiteController@ShowSite");

Route::get('/blog/{id}', "SiteController@ShowBlog");
Route::get('/blog', "SiteController@ShowAllBlog")->name('blog');
