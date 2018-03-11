<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IPModel;

class getFollowers extends Controller
{
    //

    public function get($user_id, $max_id = 0){

      $user = IPModel::with("ip")->inRandomOrder()->take(1)->get()[0];

      $instagram = new \Instagram\Instagram();
      $instagram->setProxy($user->ip);
      $instagram->initFromSavedSession($user->user_session);

      $response = $instagram->getUserFollowers($user_id, $max_id);

      $followers["followers"] = $response->getFollowers();
      $followers['next_id'] = $response->getNextMaxId();

      print_R(json_encode($followers));

      if($response->getNextMaxId() != null){
        //echo "<a href='/getfollowers/".$user_id."/".$response->getNextMaxId()."' > Next page</a>";
      }
    }
}
