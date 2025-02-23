@extends('app')
@section('title', 'Question '. $questionsList->title)
@section('description', 'Category '. $questionsList->category->name)
@section('content')
<div class="leading-loose max-w-3xl mb-4">
    {{ $questionsList->body }}
</div>
<div class="flex gap-2 text-xs text-gray-600">
    @foreach($questionsList->tags as $item)
    <a href="{{ route('tags', $item->slug) }}" class="flex items-center capitalize">
        <svg class="w-4 h-4 mr-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.56 5.86a.75.75 0 0 1 1.06 0l7.33 7.33a.75.75 0 0 1 0 1.06l-5.18 5.18a.75.75 0 0 1-1.06 0L4.75 12.5a.75.75 0 0 1 0-1.06l4.81-4.81z"></path>
            <path d="M6.08 6.08h.008v.008H6.08V6.08z"></path>
        </svg>
        {{ $item->name }}
    </a>
    @endforeach
</div>
<br/>
<h2 class="flex items-center text-4xl my-8">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3h9m-9 3h9m-7.5 3h6"></path>
    </svg>
    <span>
        {{ $questionsList->comments->count() }} comentarios
    </span>
</h2>
<br/>
@foreach($questionsList->comments as $item)
<div class="max-w-4xl">
    <div class="flex items-center font-bold">
        <svg class="w-4 h-4 mr-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.5 21a7.5 7.5 0 0 1 15 0"></path>
        </svg>
        {{ $item->user->name }}
    </div>
    <div class="text-sm">{{ $item->body }}</div>
    <hr class="my-4">
</div>
@endforeach
@endsection
