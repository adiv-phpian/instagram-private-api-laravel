<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request,
    App\IPModel,
    Session,
    App\Queue;
use \Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        //
        $user_count = IPModel::where(function ($query) {
            $query->where('active', '<', date("Y-m-d H:i:s"))
           ->orWhere('active', null);
         })->count();

        $user_m = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();
        $user = json_decode($user_m[0]->user_info)->user;

        if($user_m[0]->active > date("Y-m-d H:i:s")){
          Session::forget("pk");
          Session::forget("proxy");
          return redirect("/");
        }


        $timepause = true;
        $remaining = null;
        $last_request = '-';

        if($user_m[0]->last_comment_request != null){
          $remaining = $user_m[0]->last_comment_request->diffInseconds(Carbon::now());
          $last_request = $user_m[0]->last_comment_request->diffForHumans();
        }

        if(env('IG_INTERVAL')*60 <= $remaining || $remaining == null){
          $timepause = false;
          \Session::put("comment", true);
        }else{
          \Session::put("comment", false);
           $after_time = env('IG_INTERVAL') - round($remaining/60);
        }

        return view("actions/comment", compact('user', 'user_count', 'last_request', 'timepause', 'after_time') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function media(Request $request)
    {
        $image = $request->url;
        $id = $request->id;
        $like_count = $request->like_count;
        $comment_count = $request->comment_count;

        $user_count = IPModel::where(function ($query) {
            $query->where('active', '<', date("Y-m-d H:i:s"))
           ->orWhere('active', null);
         })->count();
        $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();
        $in_queue_count = Queue::where(['media_id' => $id, 'action_id' => 3])->sum('count');
        $user = json_decode($user[0]->user_info)->user;

        $max_count = ($user_count-1) - $in_queue_count;

        if($max_count > env('MAX_COUNT')) $max_count = env('MAX_COUNT');

        return view("actions.media_comment", compact('max_count', 'user', 'user_count',
        'id', 'image', 'like_count', 'comment_count', 'id', 'in_queue_count') );
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
        if(session("comment") != true) return redirect('/');

        $user_count = IPModel::where(function ($query) {
            $query->where('active', '<', date("Y-m-d H:i:s"))
           ->orWhere('active', null);
         })->count();
        $in_queue_count = Queue::where(['media_id' => $request->media_id, 'action_id' => 3])->sum('count');

        $comment_count = $request->count;
        if($request->count > env('MAX_COUNT')) $comment_count = env('MAX_COUNT');

        if((($user_count-1) - $in_queue_count) >= $comment_count){
          $action = array('instagram_user_id' => Session('pk'),
                          'action_id' => 3,
                          'media_id' => $request->media_id,
                          'comment' => $request->comment,
                          'count' => $comment_count
                          );

          Queue::insert($action);
          IPModel::where("instagram_user_id", session('pk'))->update(array("last_comment_request" => date("Y-m-d H:i:s")));
          $request->session()->flash('success', 'Comments on the way to your account!.');

        }else{
          $request->session()->flash('error', 'Therer\'s some problem with like request.');
        }

        return redirect('/success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
