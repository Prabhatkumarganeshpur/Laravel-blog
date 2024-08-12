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
                <h2>Tags</h2>
            </div>

            @if (Session::has('alert-success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dimiss="alert">&times;</button>
                    <strong>Success!</strong>{{ Session::get('alert-success') }}
                </div>
            @endif

            <div class="card-body">
                @if (count($tags) > 0)
                    <table class="table" id="posts">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{$tag->name}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center text-danger">No Tag Found</h3>
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
