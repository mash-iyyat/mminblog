<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogValidationRequest;
use App\Notifications\UserNotification;
use App\Models\Blog;
use App\Models\User;

class BlogsController extends Controller
{
  public function index() {
    $blogs = Blog::orderBy('created_at','DESC')->where('pinned', true)->get();
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
      'image' => $imageName,
      'slug' => str_replace([' ', '?' ,'_'], '-',$request->title)
  	]);

  	return response()->json([
      'blog' => $blog,
      'user' => $blog->user()->first(),
      'comments' => $blog->comments()->get()
    ]);
  }
  
  public function delete($id) 
  {
  	$blog = Blog::find($id);
    if ($blog->image != 'no-image.jpg') {
      Storage::delete('public/images/blog_images/'.$blog->image);
    }
    if ($blog->user_id == auth()->user()->id) {
      $blog->delete();
    }else {
      abort(403);
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

  public function update(Request $request, $id)
  {
    $blog = Blog::findOrFail($id);
    if($request->has('image')) {
      $image = $request->image;
      Storage::delete('public/images/blog_images/'.$blog->image);
      $imageName = time()."_".auth()->user()->username.".".$image->getClientOriginalExtension();
      $path = $image->storeAs('public/images/blog_images/', $imageName); 

      $blog->update($request->except('image') + [
        'image' => $imageName
      ]);
    }else {
      $blog->update($request->except('image') + [
        'image' => $blog->image
      ]);
    }
    return response()->json(['blog' => $blog]);
  }

  public function editBlog($slug)
  {
    $blog = Blog::where('slug','=',$slug)->first();
    if(auth()->user()->id == $blog->user_id) {
      return view('blogs.edit', [
        'blog' => $blog
      ]);
    }else {
      abort(404);
    }
    
  }

  public function readBlog($slug) 
  {
    $blog = Blog::where('slug','=',$slug)->first();
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

  public function search($data) 
  {
    $blog = Blog::orderBy('created_at', 'DESC')
                  ->where('title','like', '%'.$data.'%')
                  ->get();
    return response()->json(['blog' => $blog]);
  }

  public function jsonBlogs() {
    $blogs = Blog::orderBy('created_at', 'DESC')
                           ->with('user')
                           ->with('comments')
                           ->paginate(5);
    return response()->json([
      'blogs' => $blogs
    ]);
  }

  public function jsonProfileBlogs()
  {
    $blogs = auth()->user()->blogs()
                           ->orderBy('created_at','DESC')
                           ->with('user')
                           ->with('comments')
                           ->paginate(5);
    return response()->json(['blogs' => $blogs]);
  }

  public function jsonPinnedBlogs()
  {
    $pinned_blogs = Blog::orderBy('created_at','DESC')
                        ->where('pinned', true)
                        ->with('user')
                        ->paginate(5);
    return response()->json(['pinned_blogs' => $pinned_blogs]);
  }

  public function pinBlog($id) {
    $blog = Blog::findOrFail($id);
    $blog->update([ 'pinned' => true ]);

    $message = auth()->user()->username." pinned a new blog";
    auth()->user()->notify(new UserNotification($message, $blog->slug));
  }

  public function unpinBlog($id) {
    $blog = Blog::findOrFail($id);
    $blog->update([ 'pinned' => false ]);
    // $message = auth()->user()->username." pinned a new blog";
    // auth()->user()->notify(new UserNotification($message, $blog->slug));
  }

  /*============= VUE APIS ==============*/
  public function blogsJson() {
    $blogs = Blog::orderBy('created_at','DESC')->with('user')->with('comments')->paginate(6);
    return response()->json($blogs);
  }

  public function blogsJsonCreate(Request $request)
  {
    $user = User::find($request->user_id);
    $blog = $user->blogs()->create($request->all() + [
      'image' => 'no-image.jpg'
    ]);    
    return response()->json($blog);
  }

  public function blogsJsonDelete($id) {
    $blog = Blog::find($id);
    $blog->delete();
    return response()->json(['message' => 'Blog deleted']);
  }

  public function blogsJsonUpdate(Request $request, $id)
  {
    $user = User::find($request->user_id);
    $blog = Blog::find($id);
    $blog->update($request->all() + [
      'image' => 'no-image.jpg'
    ]);    
    return response()->json($blog);
  }

  public function blogsJsonFind($id) {
    $blog = Blog::find($id);
    return response()->json(['blog' => $blog]);
  }

}
