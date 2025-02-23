@extends('app')

@section('title', 'User '.$user->name)

@section('description', 'Email '.$user->email)

@section('content')
<a href="{{route('comments_user', $user)}}" class="flex items-center capitalize">See comment</a>
<div class="container px-4 mx-auto py-16">
    @foreach ($questions as $pregunta)
        @include('_item')
    @endforeach
</div>
{{ $questions->links() }}
@endsection