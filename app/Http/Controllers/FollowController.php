<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request,
App\IPModel,
Session,
App\Queue;
use \Carbon\Carbon;


class FollowController extends Controller
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
        $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->get();
        $in_queue_count = Queue::where(['action_id' => 1, 'instagram_user_id' => \Session::get('pk')])->sum('count');

        if($user[0]->active > date("Y-m-d H:i:s")){
          Session::forget("pk");
          Session::forget("proxy");
          return redirect("/");
        }

        $max_count = ($user_count-1) - $in_queue_count;

        if($max_count > env('MAX_COUNT')) $max_count = env('MAX_COUNT');

        $timepause = true;
        $remaining = null;
        $last_request = '-';

        if($user[0]->last_follow_request != null){
          $remaining = Carbon::now()->diffInseconds($user[0]->last_follow_request);
          $last_request = $user[0]->last_follow_request->diffForHumans();
        }

        if(env('IG_INTERVAL')*60 <= $remaining || $remaining == null){
          $timepause = false;
          \Session::put("follow", true);
        }else{
          \Session::put("follow", false);
        }

        $after_time = env('IG_INTERVAL') - round($remaining/60);

        $user = json_decode($user[0]->user_info)->user;

        return view("actions/follow", compact('max_count', 'user', 'user_count', 'in_queue_count', 'last_request', 'timepause', 'after_time') );
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

        if(session("follow") != true) return redirect('/');

        $user_count = IPModel::where(function ($query) {
            $query->where('active', '<', date("Y-m-d H:i:s"))
           ->orWhere('active', null);
         })->count();
        $in_queue_count = Queue::where(['action_id' => 1, 'instagram_user_id' => \Session::get('pk')])->sum('count');

        $follow_count = $request->count;
        if($request->count > env('MAX_COUNT')) $follow_count = env('MAX_COUNT');

        if((($user_count-1) - $in_queue_count) >= $follow_count){
          $action = array('instagram_user_id' => Session('pk'),
                          'action_id' => 1,
                          'count' => $follow_count
                          );

          Queue::insert($action);
          IPModel::where("instagram_user_id", session('pk'))->update(array("last_follow_request" => date("Y-m-d H:i:s")));
          $request->session()->flash('success', 'Followers on the way to your account!');

        }else{
          $request->session()->flash('error', 'Therer\'s some problem with follower request.');
        }

        return redirect('/success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        //
    }
}
