<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = 'post_like';

    public function postlike()
    {
        return $this->belongsTo('App\Post');
    }
}
