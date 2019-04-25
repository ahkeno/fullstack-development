<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function question()
    {
       return $this->hasMany(Question::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
