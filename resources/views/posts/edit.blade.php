@extends('layout')

@section('title', 'Edit Post')

@include('components.wysiwyg', ['id' => 'content'])

@section('content')
    <form method="post" action="{{ route('posts.update', $post->id) }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   aria-describedby="title" value="{{ $post->title }}">
            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" rows="6" name="content">{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
