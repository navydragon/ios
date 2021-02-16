<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAttempt extends Model
{
        protected $fillable = [
        'event_id', 'survey_id', 'user_id',
    ];

    public function answers()
    {
    	return $this->hasMany('App\SurveyAnswer','attempt_id');
    }

    public function question_answer($question_id)
    {
    	return $this->hasMany('App\SurveyAnswer','attempt_id')->where('question_id','=',$question_id)->first();
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

}
