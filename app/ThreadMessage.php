<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadMessage extends Model
{
    public function author()
    {
    	return $this->belongsTo('App\User');
    }

    public function thread()
    {
    	return $this->belongsTo('App\ForumThread','forum_thread_id');
    }
}
