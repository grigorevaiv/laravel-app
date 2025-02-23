<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="container-fluid bg-warning text-center py-3 display-4">
        Dashboard of {{ Auth::user()->name }}
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Questions of {{ Auth::user()->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('dashboard') }}">Create a new question</a>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="row justify-content-md-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header display-6 text-center">
                    Create a new comment for question {{ $question->title }}
                </div>
                <div class="container px-4 mx-auto py-16">
                    <div class="d-flex justify-content-center">
                        <form action="{{ url('dashboard_addcomment') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="body" class="form-control" placeholder="Introduce comentario ..." required/>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="question_id" value="{{ $question->id }}"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="comment" class="btn btn-success" value="Crear comentario"/>
                            </div>
                        </form>
                    </div>
                </div>
                <br/>
                <div class="leading-loose max-w-3xl mb-4">
                    {{ $question->body }}
                </div>
                <br/>
                <div class="flex gap-2 text-xs text-gray-600">
    @foreach($question->tags as $item)
        <a href="{{ route('tags', $item->slug) }}" class="flex items-center capitalize">
            <svg class="w-4 h-4 mr-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.508 3H5.25A2.25 2.25 0 003 5.25v3.75a2.25 2.25 0 002.25 2.25h4.258c.829 0 1.578-.336 2.151-.879l5.484-5.007A3.003 3.003 0 0014.992 3H9.508z" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6 6h.008v.008H6V6z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            {{ $item->name }}
        </a>
    @endforeach
</div>

<br/>

<h2 class="flex items-center text-4xl my-8">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9M9.75 12h4.5m1.5 6h-9c-.621 0-1.216-.167-1.732-.464a3 3 0 01-1.268-1.268C3.667 15.716 3.5 15.121 3.5 14.5v-5c0-.621.167-1.216.464-1.732a3 3 0 011.268-1.268C5.284 6.667 5.879 6.5 6.5 6.5h11c.621 0 1.216.167 1.732.464a3 3 0 011.268 1.268c.297.516.464 1.111.464 1.732v5c0 .621-.167 1.216-.464 1.732a3 3 0 01-1.268 1.268c-.516.297-1.111.464-1.732.464z"></path>
    </svg>
    <span>
        {{ $question->comments->count() }} comentarios
    </span>
</h2>

<br/>

@foreach($question->comments as $item)
    <div class="max-w-4xl">
        <div class="flex items-center font-bold">
        <a class="flex items-center uppercase" href="{{ route('questions_user', $item->user->name) }}">
                <svg class="w-4 h-4 mr-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.75 6.75a3 3 0 11-6 0 3 3 0 016 0zM5.25 20.25a7.5 7.5 0 1113.5-6.25v.5a3.75 3.75 0 01-3.75 3.75h-6.5a3.75 3.75 0 01-3.75-3.75v-.5"></path>
                </svg>
                {{ $item->user->name }}
            </a>
        </div>
        <div class="text-sm">
            {{ $item->body }}
        </div>
        <div class="my-4"></div>
    </div>
@endforeach

            </div>
        </div>
    </div>
</body>
</html>
