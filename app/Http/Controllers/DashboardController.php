<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\IPModel,
    \Session;

class DashboardController extends Controller
{
    //

    public function index(){

       $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();

       if($user[0]->active > date("Y-m-d H:i:s")){
         Session::forget("pk");
         Session::forget("proxy");
         return redirect("/");
       }

       return view("dashboard.dash", ["user" => json_decode($user[0]->user_info)->user]);
    }
}
