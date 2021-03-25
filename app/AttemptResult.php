<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AttemptResult extends Model
{
    protected $primaryKey = ['attempt_id','question_id','answer_id'];
    public $incrementing = false;
    protected $guarded = [];

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function answer()
    {
        return $this->belongsTo('App\TestAnswer','answer_id');
    }
    public function question()
    {
        return $this->belongsTo('App\TestQuestion','question_id');
    }
}
