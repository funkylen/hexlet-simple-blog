@extends('layout')

@section('title', 'Auth')

@section('content')
    <form method="post" action="{{ route('auth') }}">
        @csrf

        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login"
                   aria-describedby="login" value="{{ old('login') }}">
            <div class="invalid-feedback">
                @error('login') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password">
            <div class="invalid-feedback">
                @error('password') {{ $message }} @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Login</button>
    </form>
@endsection
