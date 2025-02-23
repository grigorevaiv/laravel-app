<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;

class PageController extends Controller
{
    public function home()
    {
        $questions = Question::orderBy('id', 'desc')->paginate(10);
        return view('home', compact('questions'));
    }

    public function categories(Category $categoriesList)
    {
        $questions = $categoriesList->questions()->orderBy('id', 'desc')->paginate(10);
        //compact is a PHP function that creates an array containing variables and their values
        //var_dump(compact('questions'));
        //exit;
        return view('categories', compact('categoriesList', 'questions'));
        //return "category";
    }

    public function tags(Tag $tagsList)
    {
        $questions = $tagsList->questions()->orderBy('id', 'desc')->paginate(10);
        return view('tags', compact('tagsList', 'questions'));
    }

    public function questions(Question $questionsList)
    {
        return view('question', compact('questionsList'));
    }

    public function questions_user(User $user)
    {
        $questions = $user->questions()->orderBy('id', 'desc')->paginate(10);
        return view('questions_user', compact('user', 'questions'));
    }

    public function comments_user(User $user)
    {
        $comments = $user->comments()->orderBy('id', 'desc')->paginate(10);
        return view('comments_user', compact('user', 'comments'));
    }

}
