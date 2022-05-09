@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tags') }}</div>

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

                    @if(count($tags) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $tags as $tag)
                                    <tr>
                                        <th scope="row">{{$tag->id}}</th>
                                        <td>{{$tag->name}}</td>
                                        <td>
                                            <form
                                            action="{{route('admin.tags.destroy', $tag)}}"
                                            method="post"
                                            onsubmit="return confirm('Are you sure?');">
                                                <a class="btn btn-warning" href="{{route('admin.tags.edit', $tag)}}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" >Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tags->links('pagination::bootstrap-5') }}
                        <a class="btn btn-danger" href="{{route('admin.dashboard')}}">Go Back</a>
                        <a class="btn btn-primary" href="{{route('admin.tags.create')}}">Create Tag</a>
                    @else
                        <div class="alert alert-info text-center" role="alert">
                            You don't have tags, click here <a href="{{route('admin.tags.create')}}">Create Tag</a> to create one.
                        </div>
                        <a class="btn btn-danger" href="{{route('admin.dashboard')}}">Go Back</a>
                    @endif
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
