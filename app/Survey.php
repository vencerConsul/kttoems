<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'event_id', 'survey_title', 'survey_questions'
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
