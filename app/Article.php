<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //Attributes which can be mass assigned
    protected $fillable = ['title', 'slug', 'body', 'tags', 'created_at', 'updated_at'];

    //Return user who created the article
    public function user() {
        return $this->belongsTo('App\User');
    }

    //Get tags associated with this article
    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps(); //Auto-set timestamps
    }
}
