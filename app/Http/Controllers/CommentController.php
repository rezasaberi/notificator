<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;

class CommentController extends Controller
{
  public function index(Post $post){

  	return response()->json($post->comments()->with('user')->latest()->get());
  }

  public function save(Request $request, Post $post){

  	$comment = $post->comments()->create([
  		'body' => $request->body,
  		'user_id' => Auth::id()
  	]);

  	$comment = Comment::find($comment->id)->with('user');

  	return $comment->toJson();
  }
}
