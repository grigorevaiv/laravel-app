<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categories/{categoriesList:slug}', [PageController::class, 'categories'])->name('categories');
Route::get('/tags/{tagsList:slug}', [PageController::class, 'tags'])->name('tags');
Route::get('/questions/{questionsList:slug}', [PageController::class, 'questions'])->name('question');
Route::get('/questions_user/{user:name}', [PageController::class, 'questions_user'])->name('questions_user');
Route::get('/comments_user/{user:name}', [PageController::class, 'comments_user'])->name('comments_user');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/comments', function() {
    return view('comments');
})->middleware(['auth', 'verified'])->name('comments');

Route::get('/dashboard_addquestion', function() {
    $categories = Category::orderBy('id', 'DESC')->paginate();
    return view('dashboard_addquestion', compact('categories'));
})->middleware(['auth', 'verified'])->name('dashboard_addquestion');

Route::post('dashboard_addquestion', function(Request $request) {
    $question = Question::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'body' => $request->body,
        'category_id' => $request->category_id,
        'user_id' => Auth::user()->id
    ]);
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard_addquestion');

/*Route::get('/dashboard_addcomment', function() {
    $questions = Question::orderBy('id', 'DESC')->paginate();
    return view('dashboard_addcomment', compact('questions'));
})->middleware(['auth', 'verified'])->name('dashboard_addcomment');*/

use App\Http\Controllers\CommentUserController;
Route::get('/dashboard_addcomment', [CommentUserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard_addcomment');
Route::get('/dashboard_addcomment/{question:slug}', [CommentUserController::class, 'create'])->middleware(['auth', 'verified'])->name('comment.create');

Route::post('/dashboard_addcomment', [CommentUserController::class, 'store'])->middleware(['auth', 'verified'])->name('comment.store');

use App\Http\Controllers\QuestionController;
Route::get('/question_edittags/{question:slug}', [QuestionController::class, 'edittags'])->middleware(['auth', 'verified'])->name('question.edittags');
Route::post('/dashboard_addtags', [QuestionController::class, 'storetags'])->middleware(['auth', 'verified'])->name('question.store');

Route::get('/dashboard_editquestion/{question:slug}', [QuestionController::class, 'editquestion'])->middleware(['auth', 'verified'])->name('question.editquestion');
Route::post('/dashboard_editquestion', [QuestionController::class, 'storequestion'])->middleware(['auth', 'verified'])->name('question.storechanges');
Route::get('/dashboard_delete/{question:slug}', [QuestionController::class, 'confirmdelete'])->middleware(['auth', 'verified'])->name('question.confirmdelete');
Route::delete('/dashboard_delete/{question:slug}', [QuestionController::class, 'deletequestion'])->middleware(['auth', 'verified'])->name('question.deletequestion');

Route::get('/dashboard_editcomment/{comment:id}', [CommentUserController::class, 'editcomment'])->middleware(['auth', 'verified'])->name('comments.editcomment');
Route::post('/dashboard_editcomment', [CommentUserController::class, 'updatecomment'])->middleware(['auth', 'verified'])->name('comments.updatecomment');
Route::get('/dashboard_deletecomment/{comment:id}', [CommentUserController::class, 'confirmdelete'])->middleware(['auth', 'verified'])->name('comments.confirmdelete');
Route::delete('/dashboard_deletecomment/{comment:id}', [CommentUserController::class, 'deletecomment'])->middleware(['auth', 'verified'])->name('comments.deletecomment');