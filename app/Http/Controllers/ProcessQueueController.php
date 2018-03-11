<?php

namespace App\Http\Controllers;

use App\ProcessQueue,
    App\IPModel,
    App\Follow,
    App\Like,
    App\Comment;

use Illuminate\Http\Request,
    \Instagram\Instagram;


class ProcessQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //avoid starting minute trigger
        sleep(rand(1, 5));

        $actions = ProcessQueue::where("done", 0)->with("users")->with('users.ip')->take(15)->inRandomOrder()->get();

        foreach($actions as $action){

           if($action->action_id == 1){
             $result = $this->follow($action->users, $action);
           }elseif($action->action_id == 2){
             $result = $this->like($action->users, $action);
           }elseif($action->action_id == 3){
             $result = $this->comment($action->users, $action);
           }

           ProcessQueue::where("id", $action->id)->update(["done" => $result == true ? 1 : 2]);

           sleep(rand(4, 8));
        }
    }

    /**
     * Follow the user arguments : user object going to follow user id
     *
     * @return \Illuminate\Http\Response
     */
    public function follow($user, $follow)
    {
        $instagram = new \Instagram\Instagram();
        $instagram->setProxy($user->ip);
        $instagram->initFromSavedSession($user->user_session);

        try{
            $instagram->followUser($follow->target_user_id);

            $follow_arr = array('instagram_user_id' => $user->instagram_user_id,
                          'instagram_target_user_id' => $follow->target_user_id);

            Follow::updateOrCreate(['instagram_user_id' => $user->instagram_user_id,
                                  'instagram_target_user_id' => $follow->target_user_id],
                                  $follow_arr);
            return true;

        } catch(\Exception $e){
            $this->postponeActivity($user->instagram_user_id, $e->getMessage());
            \Log::error('Follow --- '.json_encode($e->getMessage()));
            return false;
        }

    }

    /**
     * Like the user arguments : user object going to follow user id
     *
     * @return \Illuminate\Http\Response
     */
    public function like($user, $like)
    {


        try{
         $instagram = new \Instagram\Instagram();
         $instagram->setProxy($user->ip);
         $instagram->initFromSavedSession($user->user_session);

         $instagram->likeMedia($like->media_id);

          $like_arr = array('instagram_user_id' => $user->instagram_user_id,
                        'instagram_target_user_id' => $like->target_user_id,
                        'media_id' => $like->media_id);

          Like::updateOrCreate(['instagram_user_id' => $user->instagram_user_id,
                                'instagram_target_user_id' => $like->target_user_id],
                                $like_arr);
          return true;

          } catch(\Exception $e){
              $this->postponeActivity($user->instagram_user_id, $e->getMessage());
              \Log::error('Like --- '.json_encode($e->getMessage()));
              return false;
          }

    }

    /**
     * Comment the user arguments : user object going to Comment user id
     *
     * @return \Illuminate\Http\Response
     */
    public function comment($user, $comment)
    {
        try{

          $instagram = new \Instagram\Instagram();
          $instagram->setProxy($user->ip);
          $instagram->initFromSavedSession($user->user_session);

          $instagram->commentOnMedia($comment->media_id, $comment->comment);

          $comment_arr = array('instagram_user_id' => $user->instagram_user_id,
                        'instagram_target_user_id' => $comment->target_user_id,
                        'media_id' => $comment->media_id,
                        'comment' => $comment->comment);

          Comment::updateOrCreate(['instagram_user_id' => $user->instagram_user_id,
                                   'instagram_target_user_id' => $comment->target_user_id],
                                    $comment_arr);

         return true;

        } catch(\Exception $e){
            $this->postponeActivity($user->instagram_user_id, $e->getMessage());
            \Log::error('Comment --- '.json_encode($e->getMessage()));
            return false;
        }

    }

    public function postponeActivity($instagram_user_id, $error){

      if(strpos($error, "Sorry, you cannot") !== false){
        $hours = strtotime("+5 minutes");
      }elseif(strpos($error, "login_required") !== false){
        $hours = strtotime("+120 days");
      }elseif(strpos($error, "feedback_required") !== false){
        $hours = strtotime("+120 days");
      }elseif(strpos($error, "checkpoint_required") !== false){
        $hours = strtotime("+120 days");
      }else{
        $hours = strtotime("+24 hour");
      }

      IPModel::where("instagram_user_id", $instagram_user_id)->update(array("active" => date("Y-m-d H:i:s", $hours)));
    }

}
