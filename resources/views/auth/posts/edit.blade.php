@extends('layouts.auth');

@section('title', 'Edit post | Admin Dashboard');

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/multipal-dropdown.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <h2>Create Post</h2>
                </div>
                <div class="card-body">

                    @if ($errors->any())  
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" value="{{ old('title',$post->title) }}" name="title" class="form-control"
                                placeholder="Title">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Description"
                                style="resize:none">{{old('description',$post->description)}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Is Publish</label>
                            <select name="status" class="from-control">
                                <option value="" disabled selected>Choose option</option>
                                <option @selected(old('status',$post->status)==1) value="1">Publish</option>
                                <option @selected(old('status',$post->status)==0) value="0">Draft</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="from-control">
                                <option value="" disabled selected>Choose option</option>

                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option @selected(old('category',$post->category)== $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tag</label>
                            <select name="tags[]" class="from-control selectpicker" multiple data-live-search="true">
                                <option value="" disabled selected>Choose option</option>
                                @if (count($tags) > 0)
                                    @foreach ($tags as $tag)

                                    @if (count($post->tags)>0)

                                        @foreach ($post->tags as $postTag)

                                        <option @selected(old('tags',$postTag->id) == $tag->id) value="{{ $tag->id }}">{{ $tag->name }}</option>

                                        @endforeach
                                    @endif
                                    @php
                                        continue;
                                    @endphp
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label>Image</label>
                            <input type="file" value="{{ old('file') }}" name="file" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/auth/js/multi-dropdown.js') }}"></script>
@endsection
