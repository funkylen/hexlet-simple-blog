@extends('layout')

@section('title', 'Home')

@section('content')

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-header">
                {{ $post->title }}
            </div>
            <div class="card-body">
                <p class="card-text">{{ mb_strlen($post->content) > 100 ? Str::limit($post->content, 100, '...') : $post->content }}</p>
                <a href="{{ route('show_post_page', $post->id) }}" class="btn btn-primary">Open post</a>
                <a href="{{ route('edit_post_page', $post->id) }}" class="btn btn-success">Edit post</a>
            </div>
        </div>
    @endforeach


@endsection
