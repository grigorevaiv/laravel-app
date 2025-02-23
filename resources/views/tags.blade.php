@extends('app')
@section('title', 'Tags: '.$tagsList->name)
@section('description', 'This is the tags page')
@section ('content')
<div class="container px-4 mx-auto py-16">
    @foreach ($questions as $pregunta)
        @include('_item')
    @endforeach
</div>
@endsection