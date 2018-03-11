<?php

namespace App\Http\Controllers;

use App\Queue,
    App\ProcessQueue;

use Illuminate\Http\Request,
    \Session,
    App\IPModel;
use App\Follow;
use App\Like;
use App\Comment;

class QueueController extends Controller
{
    /**
     * Shedule likes, follows and comments.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */

     public function index(){

     $likes_queue = Queue::where(["onqueue" => 0])->where('updated_at', '<', date("Y-m-d H:i:s", strtotime("-5 minutes")))->orWhere('updated_at', null)->orderBy('updated_at', 'ASC')->get();

     foreach($likes_queue as $like_queue){

       $exclude_ids = array($like_queue->instagram_user_id);

       $actions_ids = array("1" => "App\Follow",
                            "2" => "App\Like",
                            "3" => "App\Comment"
                            );

        $where = array("instagram_target_user_id" => $like_queue->instagram_user_id);

       if($like_queue->action_id != 1){
         $where["media_id"] =  $like_queue->media_id;
       }

       $included_ids = $actions_ids[$like_queue->action_id]::where($where)->pluck('instagram_user_id')->toArray();

       $exclude_ids = array_merge($exclude_ids, $included_ids);

       $users = IPModel::select("instagram_user_id")->where(function ($query) {
           $query->where('active', '<', date("Y-m-d H:i:s"))
          ->orWhere('active', null);
        })->whereNotIn("instagram_user_id",$exclude_ids)
        ->take($like_queue->count)
        ->inRandomOrder()->get();

       foreach($users as $user){

         $queue = array('instagram_user_id' => $user->instagram_user_id,
                       'target_id' => $like_queue->instagram_user_id,
                       'action_id' => $like_queue->action_id,
                       'media_id' => $like_queue->media_id,
                       'comment' => $like_queue->comment);

         ProcessQueue::updateOrCreate(['instagram_user_id' => $user->instagram_user_id,
                                       'target_user_id' => $like_queue->instagram_user_id,
                                       'action_id' => $like_queue->action_id],
                                        $queue);
       }

       if($users->count() == 0){
         $update = array("updated_at" => date("Y-m-d H:i:s"));
       }else{
         $update = array("onqueue" => 1);
       }

        Queue::where("id", $like_queue->id)->update($update);

     }
   }

   /**
    * Shedule likes, follows and comments.
    *
    * @param  \App\Queue  $queue
    * @return \Illuminate\Http\Response
    */

   public function show(Queue $queue)
   {
       //
       $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();
       $user = json_decode($user[0]->user_info)->user;
       $queue = $queue->where("instagram_user_id", \Session('pk'))->get();

       $action = array("1" => "Follower",
                       "2" => "Likes",
                       "3" => "Comments");


       return view('show.queue', compact('user', 'queue', 'action'));
   }


}
