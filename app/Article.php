<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Markdown;

class Article extends Model
{
    use SoftDeletes;

    //Attributes which can be mass assigned
    protected $fillable = ['title', 'slug', 'body', 'tags', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at']; //If this value is set, the article will not be shown

    //Return user who created the article
    public function user() {
        return $this->belongsTo('App\User');
    }

    //Get tags associated with this article
    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps(); //Auto-set timestamps
    }

    //Get comments posted on this article
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    //Returns an array of ids of the tags associated with the article.
    //Called in the form automatically to get the attribute tag_list for form-model binding
    public function getTagListAttribute() {
        return $this->tags->lists('id')->all();
    }

    //Returns the article body with the markdown converted to html
    public function getMarkdownBodyAttribute() {
        return Markdown::parse($this->body);
    }

}
