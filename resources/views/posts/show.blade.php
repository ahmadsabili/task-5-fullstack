@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $post->title }}</h1>
                    <small>By: {{ $post->user->name }}</small>
                    <p>{{ $post->content }}</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary mx-1">Back</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning mx-1">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Hapus artikel?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection