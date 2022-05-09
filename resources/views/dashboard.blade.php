@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Manage</h2>
                    <div class="list-group">
                        <a
                        href="{{route('admin.categories.index')}}"
                        class="list-group-item list-group-item-action">Categories</a>
                        <a
                        href="{{route('admin.tags.index')}}"
                        class="list-group-item list-group-item-action">Tags</a>
                        <a
                        href="{{route('admin.posts.index')}}"
                        class="list-group-item list-group-item-action">Posts</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
