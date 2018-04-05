<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IPModel;

class GetMediaInfo extends Controller
{
    //

    public function get($user_id, $max_id = null){

      $user = IPModel::with("ip")->inRandomOrder()->take(1)->get()[0];

      $instagram = new \Instagram\Instagram();
      $instagram->setProxy($user->ip);
      $instagram->initFromSavedSession($user->user_session);

      $response = $instagram->getUserFeed($user_id, $max_id);

      $items = $response->getItems();

      $next_id = 0;

      if($response->isMoreAvailable()) $next_id = end($items)->getId();

      $followers["media"] = $items;
      $followers['next_id'] = $next_id;

      print_R(json_encode($followers));


    }
}
