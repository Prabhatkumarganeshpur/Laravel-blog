@extends('layouts.auth');

@section('title', 'posts');

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"rel="stylesheet" />

    <style>
        #outer {
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content">
            <div class=" card card-default">
                <h2>Create Post</h2>
            </div>

            @if (Session::has('alert-success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong>{{Session::get('alert-success')}}
            </div>
            @endif

            <div class="card-body">
                @if (count($posts) > 0)
                    <table class="table" id="posts">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">Username</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td><img src="{{asset('/storage/auth/posts/'). '/' .$post->gallery->image}}" alt="post image" style="width:50px"></td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::limit($post->description, 15) }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->status == 1 ? 'Active' : 'InActive' }}</td>
                                    <td id="outer">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info"><i
                                                class="fa fa-edit"></i></a>
                                        <form method="post" action="{{route('posts.destroy', $post->id)}}" class="inner">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit"> <a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center text-danger">No Post Found</h3>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#posts').DataTable({
                "bLengthChange": false
            });
        });
    </script>
@endsection
