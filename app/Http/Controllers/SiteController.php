<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\User;
use App\Models\Tags;
use App\Models\Categories;
use App\Models\Portfolios;
use App\Models\PortfolioCategories;
use App\Models\PortfolioImages;
use App\Models\SiteLogs;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolios::select(["portfolios.id as portfolio_id", "portfolios.*", "portfolio_categories.*", "portfolio_images.*"])
                                ->join("portfolio_images", "portfolio_images.portfolio_id", "=", "portfolios.id")
                                ->join("portfolio_categories", "portfolio_categories.id", "=", "portfolios.category_id")
                                ->groupBy("portfolios.id")
                                ->limit(9)
                                ->inRandomOrder()
                                ->get();
        $portfoliocategories = PortfolioCategories::all();
        $blogs = Blogs::orderBy('id', 'desc')->limit('3')->get();
        $users = User::orderBy('id', 'asc')->limit('4')->get();
        $hardworkers = User::all()->count();
        $projects = Portfolios::all()->count();
        $sitelog = new SiteLogs();
        $sitelog->action = "visit";
        $sitelog->save();
        return view('welcome')->with('data', ['blogs' => $blogs, "portfolios" => $portfolios, "projects" => $projects, "hardworkers" => $hardworkers, "portfoliocategories" => $portfoliocategories, "users" => $users]);
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
    public function ShowBlog($id)
    {
        $recent = Blogs::where('id', "!=", $id)->orderBy('id', 'desc')->limit('4')->get();
        $blog = Blogs::join('users', 'users.id', '=', 'blogs.user_id')->where('blogs.id', $id)->get();
        $tags = Tags::all();
        $categories = Categories::all();
        $portfoliocategories = PortfolioCategories::all();
        return view('landingcontent.single-blog')->with('data', ["blog" => $blog, "tags" => $tags, "categories" => $categories, "recent" => $recent, "portfoliocategories" => $portfoliocategories]);
    }

    public function ShowPortfolio($id)
    {
        $recent = Blogs::where('id', "!=", $id)->orderBy('id', 'desc')->limit('4')->get();
        $portfolio = Portfolios::where('id', $id)->get();
        $images = PortfolioImages::where('portfolio_id', $id)->get();
        $tags = Tags::all();
        $categories = Categories::all();
        $portfoliocategories = PortfolioCategories::all();
        return view('landingcontent.single-portfolio')->with('data', ["portfolio" => $portfolio, "images" => $images, "tags" => $tags, "categories" => $categories, "recent" => $recent, "portfoliocategories" => $portfoliocategories]);
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
    public function ShowAllBlog(Request $request){
        $tags = Tags::all();
        $categories = Categories::all();
        $recent = Blogs::orderBy('id', 'desc')->limit('4')->get();
        $portfoliocategories = PortfolioCategories::all();
        $blogs = Blogs::join('users', "users.id", "=", "blogs.user_id")->orderBy('blogs.id', 'desc')->get(["blogs.id AS blog_id", "blogs.*", "users.*"])->toArray();
        if(count($blogs) > 0){
            $limit = $request->input('limit', 5);
            $page = $request->input('page', 1);
            if ($page > count($blogs) || $page < 1) {
                $page = 1;
            }
            $offset = ($page * $limit) - $limit;
            $products_slice = array_slice($blogs, $offset, $limit);
            $datas = new Paginator($products_slice, count($blogs), $limit, $page,  [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);
            $datas->setPath('/pylonblog');
        }

        return view('landingcontent.blog')->with('data', ["blogs" => $datas, "tags" => $tags, "categories" => $categories, "recent" => $recent, "portfoliocategories" => $portfoliocategories]);
    }
    public function ShowAllPortfolio(Request $request){
        $tags = Tags::all();
        $categories = Categories::all();
        $recent = Blogs::orderBy('id', 'desc')->limit('4')->get();
        $limit = $request->input('limit', 5);
        $page = $request->input('page', 1);
        $portfolios =  Portfolios::select(["portfolios.id as portfolio_id", "portfolios.*", "portfolio_categories.*", "portfolio_images.*"])
                                ->join("portfolio_images", "portfolio_images.portfolio_id", "=", "portfolios.id")
                                ->join("portfolio_categories", "portfolio_categories.id", "=", "portfolios.category_id")    
                                ->groupBy("portfolios.id")
                                ->get()->toArray();
        if ($page > count($portfolios) || $page < 1) {
            $page = 1;
        }
        $offset = ($page * $limit) - $limit;
        $products_slice = array_slice($portfolios, $offset, $limit);
        $datas = new Paginator($products_slice, count($portfolios), $limit, $page,  [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);
        $datas->setPath('/pylonportfolio');
        $portfoliocategories = PortfolioCategories::all();
        return view('landingcontent.allportfolio')->with('data', ["portfolios" => $datas, "tags" => $tags, "categories" => $categories, "recent" => $recent, "portfoliocategories" => $portfoliocategories]);
    }
    public function ShowAllUserBlogs($id){
        $tags = Tags::all();
        $categories = Categories::all();
        $recent = Blogs::orderBy('id', 'desc')->limit('4')->get();
        $portfoliocategories = PortfolioCategories::all();
        $blogs = Blogs::join('users', "users.id", "=", "blogs.user_id")->where('users.id', "=", $id)->orderBy('blogs.id', 'desc')->get(["blogs.id AS blog_id", "blogs.*", "users.*"]);
        return view('landingcontent.blog')->with('data', ["blogs" => $blogs, "tags" => $tags, "categories" => $categories, "recent" => $recent, "portfoliocategories" => $portfoliocategories]);
    }

    public function ShowServices($id){
        $services = PortfolioCategories::where("id", "=", $id)->get();
        $portfolios = Portfolios::select(["portfolios.id as portfolio_id", "portfolios.*", "portfolio_categories.*", "portfolio_images.*"])
                                ->join("portfolio_images", "portfolio_images.portfolio_id", "=", "portfolios.id")
                                ->join("portfolio_categories", "portfolio_categories.id", "=", "portfolios.category_id")
                                ->where("portfolios.category_id", "=", $id)
                                ->groupBy("portfolios.id")
                                ->get();
        $portfoliocategories = PortfolioCategories::all();
        return view('landingcontent.single-services')->with('data', ["services" => $services, "portfolios" => $portfolios, "portfoliocategories" => $portfoliocategories]);
    }

    public function ShowAllPeople(){
        $users = User::all();
        $portfoliocategories = PortfolioCategories::all();
        return view('landingcontent.single-team')
                ->with("data", ["users" => $users, "portfoliocategories" => $portfoliocategories]);
    }

}
