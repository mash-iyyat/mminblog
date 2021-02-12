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

  	return response()->json([
  		'comment' => $comment,
		'user' => $comment->user()->get(),
		'count' => $blog->comments->count()
  	]);
  }

  public function delete($id) 
  {
	$comment = Comment::find($id);
	$blog = Blog::find($comment->blog->id);  
	$comment->delete();
	return response()->json([
	  'count' => $blog->comments->count()
	]);
  }

  public function blogComments($id)
  {
	$blog = Blog::findOrFail($id);
	$comments = $blog->comments()->orderBy('created_at','DESC')
								 ->with('user')
								 ->paginate(5);
	return response()->json([
	  'comments' => $comments,
	  'count' => $blog->comments->count()
	  ]);
  }

}
