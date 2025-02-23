@extends('app')
@section('title','Home')
@section('description','Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis fuga iusto aliquam fugit molestiae rem expedita molestias. Maiores, ullam, ratione soluta consequuntur facere illo dicta fugiat, sit voluptatem blanditiis tenetur?')
@section('content')
<div class="container px-4 mx-auto py-16">
    @foreach ($questions as $pregunta)
        @include('_item')
    @endforeach
</div>
{{ $questions->links() }}
@endsection