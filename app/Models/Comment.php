<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
    	'comment',
    	'user_id',
    	'blog_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
    	return $this->belongsTo(Blog::class, 'blog_id');
    }
}
