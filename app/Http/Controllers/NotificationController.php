<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IPModel;
use \Session;

class NotificationController extends Controller
{
    //

    public function after_request(){

      $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();

      return view('notification.after_request', ["noadd" => true, "user" => json_decode($user[0]->user_info)->user]);
    }
}
