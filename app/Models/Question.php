<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category() { return $this->belongsTo(Category::class); }
    
    public function user() { return $this->belongsTo(User::class); }

    protected $fillable = ['title', 
    'slug', 
    'body', 
    'category_id',
    'user_id'];
}
