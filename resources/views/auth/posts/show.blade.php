@extends('layouts.auth');

@section('title', 'posts show');

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"rel="stylesheet" />

@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content">
            <div class=" card card-default">
                <h2>View Post</h2>
            </div>

            <div class="card-body">
                @if ($post)
                    <table class="table" id="posts">
                        <tbody>
                            <tr>
                                <th scope="col">Title</th>
                                <td>{{$post->title}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Description</th>
                                <td>{{$post->description}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Category</th>
                                <td>{{$post->category->name}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Username</th>
                                <td>{{$post->user->name}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Status</th>
                                <td>{{$post->status == 1 ? 'Published':'Draft'}}</td>
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center text-danger">No Post Found</h3>
                @endif
            </div>
        </div>
    </div>

@endsection
