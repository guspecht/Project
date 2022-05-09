@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Posts</div>

                    <div class="card-body">
                        @if (count($posts) > 0)
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($posts as $post)
                                <div class="col">
                                    <div class="card h-100">
                                        <a href="{{ route('posts.show', $post) }}">
                                            @if($post->image)
                                                <img src="{{ asset('storage/uploads/' . $post->image) }}" class="card-img-top">
                                            @else
                                                <img src="{{ asset('images/no-image-available.png') }}" class="card-img-top">
                                            @endif
                                        </a>
                                      <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <p class="card-text">{{$post->text}}</p>
                                      </div>
                                      <div class="btn btn-outline-secondary"><a href="#"
                                        class="font-weight-bolder text-info">{{ $post->category->name }}</a>
                                    </div>
                                      <div class="card-footer">
                                        <small class="text-muted">{{ $post->created_at->format('d F Y') }}</small>
                                      </div>

                                    </div>
                                </div>

                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info text-center" role="alert">
                                Site does have Post yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
