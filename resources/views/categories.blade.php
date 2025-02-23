@extends('app')
@section('title', 'Category: '.$categoriesList->name)
@section('description', 'This is the category page')
@section ('content')
<div class="container px-4 mx-auto py-16">
    @foreach ($questions as $pregunta)
        @include('_item')
    @endforeach
</div>
{{ $questions->links() }}
@endsection