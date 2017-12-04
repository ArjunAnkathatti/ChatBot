<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRequest extends Model
{
    protected $fillable = array('user_input', 'context');
}
