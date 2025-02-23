@extends('app')

@section('title', 'User '.$user->name)

@section('description', 'Email '.$user->email)

@section('content')
<div class="container px-4 mx-auto py-16">
    @foreach ($comments as $comment)
        <p>{{ $comment->question->title }}</p>
        <p>{{ $comment->body }}</p>
        <p>{{ $comment->created_at }}</p>
    @endforeach
</div>
@endsection