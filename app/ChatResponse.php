<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatResponse extends Model
{
    protected $fillable = array('response', 'context');
}
