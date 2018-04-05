<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IPModel;

class GetUserInfo extends Controller
{
    //

    public function get($user_id, $max_id = null){

      $user = IPModel::with("ip")->inRandomOrder()->take(1)->get()[0];

      $instagram = new \Instagram\Instagram();
      $instagram->setProxy($user->ip);
      $instagram->initFromSavedSession($user->user_session);

      $response = $instagram->getUserInfo($user_id);

      print_R(json_encode($response->getUser()));


    }
}
