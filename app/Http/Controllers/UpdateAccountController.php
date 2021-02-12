<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    if ($request->has('image')) {
      $image = $request->image;
      $imageName = "profile".time()."_".auth()->user()->username.$image->getClientOriginalName();
      $path = $image->storeAs('public/images/profiles/', $imageName);
      auth()->user()->update(['image' => $imageName]);
      return response()->json($imageName);
    }  
   }

   public function checkPassword(Request $request)
   {
      if (Hash::check($request->password, auth()->user()->password)) {
        return true;
      }else {
        return response()->json(['error' => "Password does'nt match"],403);
      }
   }

   public function updatePassword(Request $request)
   {
     auth()->user()->update([
      'password' => Hash::make($request->password)
     ]);
     return response()->json(['message' => "Password succesfuly reset"]);
   }

}
