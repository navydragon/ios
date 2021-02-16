<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    public function messages()
    {
    	return $this->hasMany('App\ThreadMessage');
    }

    public function forum()
    {
        return $this->belongsTo('App\Forum');
    }

    public function last_message()
    {
    	return $this->hasMany('App\ThreadMessage')->get()->last();
    }
}
