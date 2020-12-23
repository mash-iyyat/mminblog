<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
	public function __construct() {
		$this->middleware(['guest']);
	}

  public function index()
  {
  	return view('auth.login');
  }

  public function create(Request $request)
  {
  	$this->validate($request, [
  		'email' => 'required',
  		'password' => 'required'
  	]);
  	if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
	    return back()->with('status', 'Invalid Login credentials');
	  }
	  return redirect()->route('index');
  }

}
