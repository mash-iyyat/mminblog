<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{

  public function notificationsJSON()
  {
    $notifications = auth()->user()->notifications()->paginate(10);
    return response()->json([
      'notifications' => $notifications,
      'count' => $notifications->where('read_at',null)->count()
    ]);
  }

  public function markAsRead($id)
  {
    $notification = auth()->user()->notifications->where('id',$id);
    $notification->markAsRead();
    return response()->json($notification);
  }

  public function delete($id)
  {
    $notification = auth()->user()->notifications->where('id',$id);
    $notification->delete();
  }

}
