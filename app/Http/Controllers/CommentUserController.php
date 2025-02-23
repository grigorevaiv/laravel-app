<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentUserController extends Controller
{
    function index() {
        $questions = Question::orderBy('id', 'DESC')->paginate();
        return view('comments.index', compact('questions'));
    }

    function create(Question $question) {
        return view('comments.create', compact('question'));
    }

    function store(Request $request) {
        $question = Comment::create([
            'body' => $request->body,
            'question_id' => $request->question_id,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('comments');
    }

    function editcomment(Comment $comment) {
        $question = $comment -> question;
        return view('comments.editcomment', compact('comment', 'question'));
    }

    function updatecomment(Request $request) {
        $comment = Comment::find($request->comment_id);
        $comment->update([
            'body' => $request->body,
            'question_id' => $request->question_id,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('comments');
    }

    function confirmdelete(Comment $comment) {
        $question = $comment -> question;
        return view('comments.confirmdelete', compact('comment', 'question'));
    }

    function deletecomment(Comment $comment) {
        $comment->delete();
        return redirect()->route('comments');
    }

}
