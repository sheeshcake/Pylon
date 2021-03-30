<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Portfolios;
use App\Models\SiteLogs;

class AdminController extends Controller
{
    public function ShowDashboard(){
        $blogtotal = Blogs::all()->count();
        $portfoliototal = Portfolios::all()->count();
        $sitelogs = SiteLogs::all()->count();
        return view("content.dashboard")->with("data", ["blogcount" => $blogtotal, "portofliocount" => $portfoliototal, "sitelog" => $sitelogs]);
    }
}
