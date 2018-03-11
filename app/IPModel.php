<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\ip_list;
use Carbon\Carbon;

class IPModel extends Model
{
    //

    public $timestamps = true;

    protected $fillable = ['instagram_user_id', 'user_session', 'user_info', 'proxy', 'username', 'password', 'updated_at', 'active', 'last_like_request', 'last_follow_request', 'last_comment_request'];

    protected $dates = ['last_like_request', 'last_follow_request', 'last_comment_request'];

    public function ip(){
      return $this->hasOne('\App\ip_list', 'id', 'proxy');
    }
}
