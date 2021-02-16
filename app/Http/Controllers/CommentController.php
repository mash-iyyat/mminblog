<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Blog;

class CommentController extends Controller
{
  public function create(Request $request)
  {
	$blog = Blog::find($request->blog_id);
  	$comment = auth()->user()->comments()->create($request->except('blog_id') + [
  		'blog_id' => $request->blog_id
  	]);
	
	$authorized = true;
  	return response()->json([
  		'comment' => $comment,
		'user' => $comment->user()->first(),
		'count' => $blog->comments->count(),
		'authorized' => $authorized
  	]);
  }

  public function delete($id) 
  {
	$comment = Comment::find($id);  
	$blog = Blog::find($comment->blog->id);
	
	if(auth()->user()->isMyComment($comment->user_id)) {
	  $comment->delete();
	  return response()->json([
	    'count' => $blog->comments->count()
	  ]);  
	}
  }

  public function blogComments($id)
  {
	$authorized = false;
	if(auth()->user()) { $authorized = true; }
	$blog = Blog::findOrFail($id);
	$comments = $blog->comments()->orderBy('created_at','DESC')
								 ->with('user')
								 ->paginate(5);
	return response()->json([
	  'comments' => $comments,
	  'count' => $blog->comments->count(),
	  'authorized' => $authorized
	  ]);
  }

}
