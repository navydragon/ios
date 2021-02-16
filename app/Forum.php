<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public function threads()
    {
    	return $this->hasMany('App\ForumThread');
    }

    public function messages()
    {
    	return $this->hasManyThrough('App\ThreadMessage','App\ForumThread');
    }
    public function last_message()
    {
    	return $this->hasManyThrough('App\ThreadMessage','App\ForumThread');
    }
}
