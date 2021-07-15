<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable =['title', 'start', 'end', 'starttime', 'endtime', 'event_status', 'color'];

    public function survey()
    {
        return $this->hasMany('App\Survey');
    }
}
