<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\User;

class BlogsController extends Controller
{
  public function index() {
    $blogs = Blog::orderBy('created_at','DESC')->paginate(5);
    $pinnedBlogs = Blog::orderBy('created_at','DESC')
                        ->where('pinned', true)
                        ->paginate(5);
  	return view('blogs.index', [
      'blogs' => $blogs,
      'pinnedBlogs' => $pinnedBlogs
    ]);
  }

  public function create(Request $request)
  {
    $imageName = 'no-image.jpg';
    if($request->has('image')){
      $image = $request->image;
      $imageName = time()."_".auth()->user()->username.$image->getClientOriginalName();
      $path = $image->storeAs('public/images/blog_images/', $imageName); 
    }
    
  	$blog = auth()->user()->blogs()->create($request->except('image') + [
  		'image' => $imageName,
  		'pinned' => false
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
  	$blog->delete();
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
        'image' => $imageName,
        'pinned' => false
      ]);
    }else {
      $blog->update($request->except('image') + [
        'image' => $blog->image,
        'pinned' => false
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
    return view('blogs.readblog', [
      'blog' => $blog
    ]);
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

}
