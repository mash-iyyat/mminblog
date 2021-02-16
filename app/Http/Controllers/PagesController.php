<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class PagesController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}

  public function profile() {
	$users = User::orderBy('created_at','DESC')->limit(10)->get();
  	$blogs = Blog::paginate(10);
  	return view('pages.profile', [
		  'blogs' => $blogs,
		  'users' => $users
  	]);
  }

  public function setting()
  {
    return view('pages.setting');
  }

  public function notifications()
  {
	  return view('pages.notifications');
  }

}
