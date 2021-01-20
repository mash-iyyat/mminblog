<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogValidationRequest;
use App\Models\Blog;
use App\Models\User;

class BlogsController extends Controller
{
  public function index() {
    $blogs = Blog::orderBy('created_at','DESC')->paginate(5);
    $users = User::orderBy('created_at','DESC')->get();
    $pinnedBlogs = Blog::orderBy('created_at','DESC')
                        ->where('pinned', true)
                        ->paginate(5);
  	return view('blogs.index', [
      'blogs' => $blogs,
      'pinnedBlogs' => $pinnedBlogs,
      'users' => $users
    ]);
  }

  public function create(BlogValidationRequest $request)
  {
    $imageName = 'no-image.jpg';
    if($request->has('image')){
      $image = $request->image;
      $imageName = time()."_".auth()->user()->username.$image->getClientOriginalName();
      $path = $image->storeAs('public/images/blog_images/', $imageName); 
    }
    
  	$blog = auth()->user()->blogs()->create($request->except('image') + [
  		'image' => $imageName
  	]);

  	return response()->json([
      'blog' => $blog,
      'user' => $blog->user()->get()
    ]);
  }

  public function delete($id) 
  {
  	$blog = Blog::find($id);
    if ($blog->image != 'no-image.jpg') {
      Storage::delete('public/images/blog_images/'.$blog->image);
    }
    if ($blog->belongsToMe(auth()->user()->id)) {
      $blog->delete();
    }else {
      abort(404);
    }
  	
  }

  public function find($id) 
  {
  	$blog = Blog::find($id);
    return response()->json([
      'blog' => $blog,
      'user' => $blog->user()->get()
    ]);
  }

  public function update(Request $request ,$id)
  {
  	$blog = Blog::find($id);
    if($request->has('image')){
      $image = $request->image;
      Storage::delete('public/images/blog_images/'.$blog->image);
      $imageName = time()."_".auth()->user()->username.$image->getClientOriginalName();
      $path = $image->storeAs('public/images/blog_images/', $imageName); 

      $blog->update($request->except('image') + [
        'image' => $imageName
      ]);
    }else {
      $blog->update($request->except('image') + [
        'image' => $blog->image
      ]);  
    }

    return response()->json([
      'blog' => $blog,
      'user' => $blog->user()->get()
    ]);
  }

  public function readBlog($id) 
  {
    $blog = Blog::find($id);
    $users = User::orderBy('created_at','DESC')->get();
    if (!$blog) {
      abort(404);
    }else {
      return view('blogs.readblog', [
        'blog' => $blog,
        'users' => $users
      ]);  
    }
    
  }

  public function paginate()
  {
    $blogs = Blog::orderBy('created_at','DESC')
                  ->with('user')
                  ->paginate(5);
    return response()->json($blogs);
  }

  public function viewMoreProfileBlog()
  {
    $blogs = auth()->user()->blogs()
                           ->with('user')
                           ->paginate(5);
    return response()->json($blogs);
  }

  public function pinBlog($id) {
    $blog = Blog::findOrFail($id);
    $blog->update([ 'pinned' => true ]);
  }

  public function unpinBlog($id) {
    $blog = Blog::findOrFail($id);
    $blog->update([ 'pinned' => false ]);
  }

}
