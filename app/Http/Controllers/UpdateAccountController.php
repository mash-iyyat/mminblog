<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateAccountController extends Controller
{
   public function __construct()
   {
     $this->middleware('auth');
   } 

   public function updateInfo(Request $request) 
   {
     $user = auth()->user();
     $user->update($request->all());
     return response()->json($request->all());
   }

   public function updateImage(Request $request)
   {
     $updateImage = auth()->user()->image;
     return response()->json($updateImage);
   }

}
