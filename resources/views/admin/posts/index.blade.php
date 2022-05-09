@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('errors'))
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">text</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $posts as $post)
                                    <tr>
                                        <th scope="row">{{$post->id}}</th>
                                        <td>
                                            @if($post->image)
                                                <img src="{{ asset('storage/uploads/' . $post->image) }}" width="100"
                                                    height="100" class="img-fluid">
                                            @else
                                                <img src="{{ asset('images/no-image-available.png') }}" width="100" height="100"
                                                    class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->text}}</td>
                                        <td>{{$post->category->name}}</td>
                                        <td>
                                            @foreach ($post->tags as $tag)
                                                {{$tag->name}},
                                            @endforeach
                                        </td>
                                        <td>{{$post->text}}</td>
                                        <td>
                                            <form
                                            action="{{route('admin.posts.destroy', $post)}}"
                                            method="post"
                                            onsubmit="return confirm('Are you sure?');">
                                                <a class="btn btn-warning" href="{{route('admin.posts.edit', $post)}}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" >Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links('pagination::bootstrap-5') }}
                        <a class="btn btn-danger" href="{{route('admin.dashboard')}}">Go Back</a>
                        <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Create post</a>
                    @else
                        <div class="alert alert-info text-center" role="alert">
                            You don't have posts, click here <a href="{{route('admin.posts.create')}}">Create post</a> to create one.
                        </div>
                        <a class="btn btn-danger" href="{{route('admin.dashboard')}}">Go Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
