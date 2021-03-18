<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CategoriesController;
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

    Route::prefix('/blogs')->group(function(){
        //blogs
        Route::get('/', 'BlogsController@ShowAllBlogs');
        Route::get('/viewblog/{id}', 'BlogsController@ShowBlog')->name('viewblog');
        Route::get('/newblog', 'BlogsController@ShowNewBlog')->name('newblog');
        Route::post('/newblog', 'BlogsController@AddNewBlog')->name('addblog');
        Route::post('/updateblog', 'BlogsController@UpdateBlog')->name('updateblog');
        Route::get('/removeblog/{id}', 'BlogsController@RemoveBlog')->name('removeblog');
    });

    Route::prefix('/tags')->group(function(){
        Route::post('/addtag', "TagsController@AddTag")->name("addtag");
        Route::post('/updatetag/{id}', "TagsController@UpdateTag")->name("updatetag");
        Route::get('/removetag/{id}', "TagsController@RemoveTag")->name("removetag");
    });

    Route::prefix('/categories')->group(function(){
        Route::post('/addcategory', "CategoriesController@AddCategory")->name("addcategory");
        Route::post('/updatecategory/{id}', "CategoriesController@UpdateCategory")->name("updatecategory");
        Route::get('/removecategory/{id}', "CategoriesController@RemoveCategory")->name("removecategory");
    });


    //portfolio
    Route::prefix('/portfolio')->group(function(){
        Route::get("/", "PortfolioController@ShowPortfolios")->name('portfolio');
        Route::get('/viewportfolio/{id}', 'PortfolioController@ShowPortfolio')->name('viewportfolio');
        Route::get('/newportfolio', 'PortfolioController@ShowNewPortfolio')->name('newportfolio');
        Route::post('/newportfolio', 'PortfolioController@AddNewPortfolio')->name('addportfolio');
        Route::post('/updateportfolio', 'PortfolioController@UpdatePortfolio')->name('updateportfolio');
        Route::get('/removeportfolio/{id}', 'PortfolioController@RemovePortfolio')->name('removeportfolio');
    });

    Route::prefix('/portfoliocategories')->group(function(){
        Route::post('/addportfoliocategory', "CategoriesController@AddCategory")->name("addcategory");
        Route::post('/updateportfoliocategory/{id}', "CategoriesController@UpdateCategory")->name("updatecategory");
        Route::get('/removeportfoliocategory/{id}', "CategoriesController@RemoveCategory")->name("removecategory");
    });

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



Route::group(['prefix' => '/'], function () {
    Route::get('/', "SiteController@index");
    Route::get('/pylonblog/{id}', "SiteController@show");
    Route::get('/team/{id}', "SiteController@ShowAllUserBlogs");
    Route::get('/pylonblog', "SiteController@ShowAllBlog")->name('pylonblog');
});



