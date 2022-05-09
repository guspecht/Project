@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        <div class="">
                            @if($post->image)
                            <img src="{{ asset('storage/uploads/' . $post->image) }}" width="100"
                                height="100" class="img-fluid">
                            @else
                                <img src="{{ asset('images/no-image-available.png') }}" width="100" height="100"
                                    class="img-fluid">
                            @endif
                        </div>

                        <div class="my-5">{!! nl2br($post->text) !!}</div>

                        @foreach ($post->tags as $tag)
                            <a href="#" class="btn btn-outline-secondary">#{{ $tag->name }}</a>
                        @endforeach

                        <div class="mt-3">
                            <a href="/" class="btn btn-danger">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
