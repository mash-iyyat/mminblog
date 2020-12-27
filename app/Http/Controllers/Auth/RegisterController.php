<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
  
  public function __construct() 
  {
    $this->middleware(['guest']);
  }

  public function index()
  {
  	return view('auth.register');
  }

  public function create(Request $request)
  {
  	$user = User::create($request->except('password') + [
  		'password' => Hash::make($request->password),
  		'image' => 'no-image.jpg'
  	]);
  	auth()->attempt($request->only('email', 'password'));
  	
  	return redirect()->route('blogs');
  }

}
