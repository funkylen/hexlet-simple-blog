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
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Open post</a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit post</a>
                <form class="d-inline" method="POST" action="{{ route('posts.destroy', $post->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete post</button>
                </form>
            </div>
        </div>
    @endforeach


@endsection
