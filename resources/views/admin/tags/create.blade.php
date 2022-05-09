@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create tag') }}</div>

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
                    <form action="{{route('admin.tags.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label" >tag Name:</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Insert tag Name" required>
                        </div>
                        <a href="{{route('admin.tags.index')}}" type="submit" class="btn btn-danger">Go Back</a>
                        <button type="submit" class="btn btn-primary">Add tag</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
