@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  {{ __('Dashboard') }}
                  <div class="float-end">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
                  </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                      @foreach ($posts as $post)
                      <div class="col">
                        <div class="card">
                          <img src="..." class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">{{ $post['title']}}</h5>
                            <p class="card-text">{{ $post['content'] }}</p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
                <div class="card-footer">
                  {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
