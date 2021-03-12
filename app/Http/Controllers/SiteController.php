<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\User;
use App\Models\Tags;
use App\Models\Categories;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::orderBy('id', 'desc')->limit('3')->get();
        return view('welcome')->with('data', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recent = Blogs::where('id', "!=", $id)->orderBy('id', 'desc')->limit('4')->get();
        $blog = Blogs::join('users', 'users.id', '=', 'blogs.user_id')->where('blogs.id', $id)->get();
        $tags = Tags::all();
        $categories = Categories::all();
        return view('landingcontent.single-blog')->with('data', ["blog" => $blog, "tags" => $tags, "categories" => $categories, "recent" => $recent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ShowAllBlog(){
        $tags = Tags::all();
        $categories = Categories::all();
        $recent = Blogs::orderBy('id', 'desc')->limit('4')->get();
        $blogs = Blogs::join('users', "users.id", "=", "blogs.user_id")->orderBy('blogs.id', 'desc')->get(["blogs.id AS blog_id", "blogs.*", "users.*"]);
        return view('landingcontent.blog')->with('data', ["blogs" => $blogs, "tags" => $tags, "categories" => $categories, "recent" => $recent]);
    }
    public function ShowAllUserBlogs($id){
        $tags = Tags::all();
        $categories = Categories::all();
        $recent = Blogs::orderBy('id', 'desc')->limit('4')->get();
        $blogs = Blogs::join('users', "users.id", "=", "blogs.user_id")->where('users.id', "=", $id)->orderBy('blogs.id', 'desc')->get(["blogs.id AS blog_id", "blogs.*", "users.*"]);
        return view('landingcontent.blog')->with('data', ["blogs" => $blogs, "tags" => $tags, "categories" => $categories, "recent" => $recent]);
    }
}
