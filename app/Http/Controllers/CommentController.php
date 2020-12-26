<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
  public function create(Request $request)
  {
  	$comment = auth()->user()->comments()->create($request->except('blog_id') + [
  		'blog_id' => $request->blog_id
  	]);

  	return response()->json([
  		'comment' => $comment,
  		'user' => $comment->user()->get()
  	]);
  }

  public function delete($id) 
  {
  	
  }

}
