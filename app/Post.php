<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'title', 'content'
    ];

    public function user(){

    	return $this->belongsTo('App\User', 'author_id');
    }

    public function comments(){

    	return $this->hasMany('App\Comment');
    }
}
