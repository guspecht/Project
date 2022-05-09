@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('admin.posts.update', $post)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label" >Post Title:</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="Insert post title" value="{{ old('title', $post->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label" >Post Text:</label>
                            <textarea class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" id="text" name="text" rows="3" placeholder="Insert post text" required>{{ old('text', $post->text) }}</textarea>
                            @if($errors->has('text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label" >Post Tags:</label>
                            <textarea class="form-control  {{ $errors->has('tags') ? 'is-invalid' : '' }}" id="tags" name="tags" rows="3" placeholder="Insert post tags" required>{{ old('tags', $tags) }}</textarea>
                            <span class="small">Separated by comma Ex: Tag1,Tag2,Tag3....</span>
                            @if($errors->has('tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tags') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category"
                                id="category" required aria-label="category">
                                <option value="0"> SELECT CATEGORY </option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}"
                                    @if($category->id == old('category', $post->category->id)) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Post Image</label>
                            <input class="form-control form-control-sm" id="image" name="image" type="file">
                        </div>
                        <a href="{{route('admin.posts.index')}}" type="submit" class="btn btn-danger">Go Back</a>
                        <button type="submit" class="btn btn-primary">Update post</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
