<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class PagesController extends Controller
{
  public function profile() {
  	$blogs = Blog::paginate(10);
  	return view('pages.profile', [
  		'blogs' => $blogs
  	]);
  }
}
