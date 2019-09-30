<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller{

  public function index(){
  	
  	$data['posts'] = Post::orderBy('id', 'DESC')->get();

  	return view('post.index', $data);
  }

  public function view($id){
  	
  	$data['post'] = Post::where('id', $id)->with('user')->first();
    //echo "<pre>"; print_r($data['post']); exit;
    //$data['post'] = Post::find($id)->with('user');
  	//$data['comments'] = Comment::where('post_id', $id)->get();

  	return view('post.view', $data);
  }
}
