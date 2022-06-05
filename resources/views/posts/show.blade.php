@extends('layout')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>
        {!! $post->content !!}
    </p>

    @if(session('auth'))
    <form class="d-inline" method="POST" action="{{ route('posts.destroy', $post->id) }}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Delete post</button>
    </form>
    @endif()
@endsection
