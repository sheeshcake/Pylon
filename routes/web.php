<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PortfolioCategoriesController;
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
    Route::get('/dashboard', "AdminController@ShowDashboard")->name('dashboard');

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

    //portfolio categories
    Route::prefix('/services')->group(function(){
        Route::get("/", "PortfolioCategoriesController@ShowAllCategory")->name('services');
        Route::get("/newservices", "PortfolioCategoriesController@ShowAddCategory")->name('newservices');
        Route::get('/viewservices/{id}', 'PortfolioCategoriesController@ShowCategory')->name('viewservices');
        Route::post('/addservices', "PortfolioCategoriesController@AddCategory")->name("addservices");
        Route::post('/updateservices', "PortfolioCategoriesController@UpdateCategory")->name("updateservices");
        Route::get('/removeservices/{id}', "PortfolioCategoriesController@RemoveCategory")->name("removeservices");
    });

    Route::prefix("/accounts")->group(function(){
        Route::get("/", "AdminController@ShowAllUsers")->name("accounts");
        Route::get("/newuser", "AdminController@ShowAddUser")->name("newuser");
        Route::get("/removeuser/{id}", "AdminController@RemoveUser")->name("removeuser");
        Route::post("/updateuser", "AdminController@UpdateUser")->name("updateuser");
        Route::post("/adduser", "AdminController@AddUser")->name("adduser");
        Route::get("/viewuser/{id}", "AdminController@ShowUser")->name("viewuser");
    });
    // if(Auth::user()->user_role == "client"){
        Route::prefix("/timetrack")->group(function(){
            Route::get("/", "TimeTrackVAController@ShowRooms")->name('timetrack');
            Route::get("/room/{id}", "TimeTrackVAController@JoinRoom")->name('joinva');
            Route::post("/leave", "TimeTrackVAController@LeaveRoom")->name('leave');
            Route::post('/update', "TimeTrackVAController@UploadReport")->name('update');
            Route::post('/refresh', "TimeTrackVAController@UpdateLastActivity")->name('refresh');
        });
    // }else if(Auth::user()->user_role == "va"){
        Route::prefix("/rooms")->group(function(){
            Route::get("/", "TimeTrackClientController@ShowRooms")->name("rooms");
            Route::get("/newroom", "TimeTrackClientController@ShowNewRoom")->name("newroom");
            Route::post("/addroom", "TimeTrackClientController@AddRoom")->name("addroom");
            Route::post("/removeroom", "TimeTrackClientController@RemoveRoom")->name("removeroom");
            Route::get("/room/{id}", "TimeTrackClientController@JoinRoom")->name("joinclient");
            Route::get("/getupdate", "TimeTrackClientController@GetUpdate")->name("getupdate");
            Route::post("/getsession", "TimeTrackClientController@GetSessions")->name("getsessions");
            Route::get("/download/{id}", "TimeTrackClientController@DownloadSession")->name("download");
        });
    // }
    //Chat System
    Route::prefix("/chat")->group(function(){
        Route::get("/", "ChatController@GetChats")->name("chat");
        Route::post("/", "ChatController@SendChat")->name("chat");
    });

    Route::prefix("/profile")->group(function(){
        Route::get("/", "AdminController@ShowProfile")->name("profile");
        Route::post("/updateprofile", "AdminController@UpdateUser")->name("updateprofile");
    });
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
    Route::get('/pylonblog/{id}', "SiteController@ShowBlog");
    Route::get('/pylonportfolio/{id}', "SiteController@ShowPortfolio");
    Route::get('/pylonservices/{id}', "SiteController@ShowServices");
    Route::get('/team/{id}', "SiteController@ShowAllUserBlogs");
    Route::get('/pylonblog', "SiteController@ShowAllBlog")->name('pylonblog');
    Route::get('/pylonportfolio', "SiteController@ShowAllPortfolio")->name('pylonportfolio');
    Route::get('/pylonservices', "SiteController@ShowAllServices")->name('pylonservices');
    Route::get('/pylonteam', "SiteController@ShowAllPeople")->name('pylonteam');
});



