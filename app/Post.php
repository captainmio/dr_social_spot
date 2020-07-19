<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postlike()
    {
        return $this->hasMany('App\PostLike');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->where('parent_id', '=', 0);
    }
}
