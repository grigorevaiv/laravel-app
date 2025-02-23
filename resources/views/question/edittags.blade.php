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
    Dashboard de {{ Auth::user()->name }}
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
                <a class="nav-link" href="{{ route('dashboard_addcomment') }}">Comment a question</a>
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
    <div class="col-md-10">
        <div class="card">
            <div class="card-header display-6 text-center">
                Add a tag
            </div>
            <div class="card-body">
                <form action="{{ url('dashboard_addtags') }}" method="POST">
                    @csrf
                    @foreach ($tags as $tag)
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}"
    @if (in_array($tag->id, $question->tags->pluck('id')->toArray())) checked @endif
>

                            <label class="form-check-label" for="tag{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="question_id" value="{{ $question->id }}"/>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-3">Save Tags</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>