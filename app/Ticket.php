<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function type()
    {
    	return $this->belongsTo('App\TicketType','ticket_type_id');
    }

    public function author()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function get_badge_class()
    {
    	switch($this->ticket_type_id)
    	{
			case(1): $class="badge-outline-danger"; break;
			case(2): $class="badge-outline-primary"; break;
			case(3): $class="badge-outline-success"; break;
			case(4): $class="badge-outline-info"; break;
			case(5): $class="badge-outline-dark"; break;
			default: $class="badge-outline-default";
		}
		return $class;
    }

    public function files()
    {
    	return $this->hasMany('App\TicketFile');
    }
}
