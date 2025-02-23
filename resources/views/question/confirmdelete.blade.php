<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <title>Dashboard</title>
</head>
<body>
<header class="container-fluid bg-warning text-center py-3 display-4">
    Dashboard of {{ Auth::user()->name }}
</header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Questions of {{ Auth::user()->name }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('comments') }}">Comments of {{ Auth::user()->name }}</a>
                <a class="nav-link" href="{{ route('dashboard_addquestion') }}">Create a new question</a>
                <a class="nav-link" href="#">Comment a question</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        {{ __('Logout') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="row justify-content-md-center">
    <div class="col-md-10 text-center">
        <div class="card">
            <div class="card-header display-6">
                Are you sure you want to delete the question?
            </div>
            <div class="card-body">
                <!-- Заголовок вопроса -->
                <h2 class="text-2xl mb-4">{{ $question->title }}</h2>
                
                <!-- Текст вопроса -->
                <p class="mb-4">{{ $question->body }}</p>
                
                <!-- Категория -->
                <div class="text-xs text-gray-600 flex items-center justify-center">
                    <div class="flex gap-4 me-3">
                    Category:
                    <a class="flex items-center uppercase" href="{{ route('categories', $question->category->slug) }}">
                           
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                                <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5z"/>
                            </svg>
                             {{ $question->category->name }}
                        </a>
                    </div>

                    <div class="flex gap-2">
                        Tags: 
                        @foreach ($question->tags as $tag)
                            <a href="{{ route('tags', $tag->slug) }}" class="flex items-center capitalize">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
                                    <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0"/>
                                    <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z"/>
                                </svg>
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <form method="POST" action="{{ route('question.deletequestion', $question) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="mt-4">
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">No, cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>
