@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  {{ __('Dashboard') }}
                  <div class="float-end">
                      <a href="{{ route('categories.index') }}" class="btn btn-primary">Category</a>
                      <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
                  </div>
                </div>
                <div class="card-body">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                      @foreach ($posts as $post)
                      <div class="col">
                        <div class="card">
                          <a href="{{ route('posts.show', $post->id) }}">
                          <img src="{{ Storage::url($post->image) }}" class="card-img-top" style="width: 100%; height:15vw; object-fit:contain">
                          <div class="card-body">
                            <h5 class="card-title">{{ $post->title}}</h5>
                          </a>
                            <small>By: <strong>{{ $post->user->name }}</strong></small>
                            <p class="card-text">{{ $post->content }}</p>
                            <small>Category: {{ $post->category->name }}</small>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
