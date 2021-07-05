<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['user_id', 'firstname', 'middlename', 'lastname', 'suffix', 'email','survey_title','survey_id','comment', 'key1','key2','key3','key4','key5','key6'];
}
