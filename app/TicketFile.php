<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TicketFile extends Model
{
    public function source()
    {
    	return $this->belongsTo('App\File','file_id');
    }

    public function load_date()
    {
    	return Carbon::parse($this->created_at)->format('d.m.Y H:i:s');
    }
}
