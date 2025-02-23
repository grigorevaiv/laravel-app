<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    public function user() { return $this->belongsTo(User::class); }

    public function question() { return $this->belongsTo(Question::class); }

    protected $fillable = ['body', 'question_id', 'user_id'];
}
