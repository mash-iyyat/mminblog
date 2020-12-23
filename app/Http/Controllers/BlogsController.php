<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{
  public function index() {
    $blogs = Blog::paginate(5);
  	return view('blogs.index', [
      'blogs' => $blogs
    ]);
  }

  public function create(Request $request)
  {
  	$blog = auth()->user()->blogs()->create($request->except('image') + [
  		'image' => 'no-image.jpg',
  		'pinned' => false
  	]);

  	return response($request->all());
  }

  public function delete($id) 
  {
  	$blog = Blog::find($id);
  	$blog->delete();
  }

  public function find($id) 
  {
  	$blog = Blog::find($id);
  }

  public function update(Request $request ,$id)
  {
  	$blog = Blog::find($id);
  	$blog->update($request->all());
  }

}
