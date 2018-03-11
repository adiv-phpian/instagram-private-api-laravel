<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IPModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $today_count = IPModel::where("created_at", ">=", date("Y-m-d"))->count();
      $login_count = IPModel::where("updated_at", ">=", date("Y-m-d"))->count();
      $total_count = IPModel::count();


      return view('home', compact('today_count', 'login_count', 'total_count'));
    }
}
