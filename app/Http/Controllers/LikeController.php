<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\IPModel,
App\Queue,
\Session;
use \Carbon\Carbon;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $timepause = true;
        $remaining = null;
        $last_request = '-';

        if($user_m[0]->active > date("Y-m-d H:i:s")){
          Session::forget("pk");
          Session::forget("proxy");
          return redirect("/");
        }

        if($user_m[0]->last_like_request != null){
          $remaining = $user_m[0]->last_like_request->diffInseconds(Carbon::now());
          $last_request = $user_m[0]->last_like_request->diffForHumans();
        }

        if(env('IG_INTERVAL')*60 <= $remaining || $remaining == null ){
          $timepause = false;
          \Session::put("like", true);
        }else{
          \Session::put("like", false);
           $after_time = env('IG_INTERVAL') - round($remaining/60);
        }

        return view("actions/like", compact('user', 'user_count', 'last_request', 'timepause', 'after_time') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function media(Request $request)
    {
        //
        $image = $request->url;
        $id = $request->id;
        $like_count = $request->like_count;
        $comment_count = $request->comment_count;

        $user_count = IPModel::where(function ($query) {
            $query->where('active', '<', date("Y-m-d H:i:s"))
           ->orWhere('active', null);
         })->count();
        $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();
        $in_queue_count = Queue::where(['media_id' => $id, 'action_id' => 2])->sum('count');
        $user = json_decode($user[0]->user_info)->user;

        $max_count = ($user_count-1) - $in_queue_count;

        if($max_count > env('MAX_COUNT')) $max_count = env('MAX_COUNT');

        return view("actions.media_like", compact('max_count', 'user', 'user_count', 'image', 'like_count', 'comment_count', 'id', 'in_queue_count') );
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

        if(session("like") != true) return redirect('/');

        $user_count = IPModel::where(function ($query) {
            $query->where('active', '<', date("Y-m-d H:i:s"))
           ->orWhere('active', null);
         })->count();
        $in_queue_count = Queue::where(['media_id' => $request->media_id, 'action_id' => 2])->sum('count');

        $like_count = $request->count;
        if($request->count > env('MAX_COUNT')) $like_count = env('MAX_COUNT');

        if((($user_count-1) - $in_queue_count) >= $like_count){

          $action = array('instagram_user_id' => Session('pk'),
                          'action_id' => 2,
                          'media_id' => $request->media_id,
                          'count' => $like_count
                          );

          Queue::insert($action);

          IPModel::where("instagram_user_id", session('pk'))->update(array("last_like_request" => date("Y-m-d H:i:s")));

          $request->session()->flash('success', 'Likes on the way to your account!');

        }else{
          $request->session()->flash('error', 'Therer\'s some problem with like request.');
        }

        return redirect('/success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
