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
                Edit the comment
            </div>

            <div class="p-4">
                <div class="container px-4 mx-auto py-16">
                <div class="text-xl mb-4"> Pregunta de este comentario: <b>{{$comment->question->title}}</b> </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-5">
                            <form action="{{ route('comments.updatecomment') }}" method="post">
                            @csrf
                                <div class="input-group">
                                    <span class="input-group-text">comment</span>
                                    <input type="text" name="body" class="form-control" value="{{ old('body', $comment->body) }}" required/>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="question_id" value="{{ $comment->question->id }}"/>
                                </div>
                                <br/>
                                <div class="input-group">
                                    <input type="submit" name="update" class="btn btn-success" value="Guardar cambios">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
