@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

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
                    <form action="{{route('admin.categories.update', $category)}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                          <label for="name" class="form-label" >Category Name:</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{old('name', $category->name)}}" required>
                        </div>

                        <a href="{{route('admin.categories.index')}}" type="submit" class="btn btn-danger">Go Back</a>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
