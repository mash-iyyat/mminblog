<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
    	'content',
    	'user_id',
    	'image',
    	'pinned'
    ];

    protected $attributes = [
        'pinned' => false
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

}
