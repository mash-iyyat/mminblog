<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
    	'title',
    	'content',
    	'user_id',
    	'image',
      'pinned',
      'slug'
    ];

    protected $attributes = [
        'pinned' => false
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function comments()
    {
      return $this->hasMany(Comment::class, 'blog_id');
    }

    public function belongsToMe($user_id)
    {
      if($this->user_id == $user_id) {
        return true;
      }
    }

}
