@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

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

                    @if(count($categories) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $categories as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <form
                                            action="{{route('admin.categories.destroy', $category)}}"
                                            method="post"
                                            onsubmit="return confirm('Are you sure?');">
                                                <a class="btn btn-warning" href="{{route('admin.categories.edit', $category)}}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" >Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links('pagination::bootstrap-5') }}
                        <a class="btn btn-danger" href="{{route('admin.dashboard')}}">Go Back</a>
                        <a class="btn btn-primary" href="{{route('admin.categories.create')}}">Create Category</a>
                    @else
                        <div class="alert alert-info text-center" role="alert">
                            You don't have categories, click here <a href="{{route('admin.categories.create')}}">Create Category</a> to create one.
                        </div>
                        <a class="btn btn-danger" href="{{route('admin.dashboard')}}">Go Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
