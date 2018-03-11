<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessQueue extends Model
{
    //

    public $timestamps = true;

    protected $fillable = ['instagram_user_id', 'target_user_id', 'media_id', 'action_id', 'comment'];

    public function users(){
      return $this->hasOne('\App\IPModel', 'instagram_user_id', 'instagram_user_id');
    }

}
