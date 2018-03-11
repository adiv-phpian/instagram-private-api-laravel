<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public $timestamps = true;

    protected $fillable = ['instagram_user_id', 'instagram_target_user_id', 'media_id'];
}
