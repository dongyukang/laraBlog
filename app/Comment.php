<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body'];
    //Returns the article this comment is posted on
    public function article() {
        return $this->belongsTo('App\Article');
    }

    //Returns the user who posted this comment
    public function user() {
        return $this->belongsTo('App\User');
    }
}
