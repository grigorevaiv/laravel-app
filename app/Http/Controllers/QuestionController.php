<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    function edittags(Question $question) {
        $tags = Tag::orderBy('id', 'DESC')->paginate();
        return view('question.edittags', compact('question', 'tags'));
    }

    function storetags(Request $request) {
        $question = Question::find($request->question_id);
        // смотря что я хочу сделать - полностью обновить тэги или нет
        // есть подозрение что тэги, которые уже есть, должны быть как-то помечены
        // для этого надо их ретривнуть и сравнить с теми, что пришли
        $question->tags()->sync($request->tags);
        return redirect()->route('dashboard');
    }

    function editquestion(Question $question) {
        $categories = Category::orderBy('id', 'DESC')->paginate();
        return view('question.editquestion', compact('question', 'categories'));
    }

    function storequestion(Request $request) {
        $question = Question::find($request->question_id);
        $question->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('dashboard');
    }

    function confirmdelete(Question $question) {
        return view('question.confirmdelete', compact('question'));
    }

    function deletequestion(Question $question) {
        $question->delete();
        return redirect()->route('dashboard');
    }
}