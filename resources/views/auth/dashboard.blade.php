@extends('layouts.auth')

@section('styles')
    {{-- <link href="{{ asset('assets/auth/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" /> --}}
@endsection
@section('content')
    {{-- <div class="page-wrapper"> --}}

        <!-- Header -->
        <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
                <!-- Sidebar toggle button -->
                <button id="sidebar-toggler" class="sidebar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                </button>

                <span class="page-title">dashboard</span>

                <div class="navbar-right ">


                    <ul class="nav navbar-nav">
                        <li class="dropdown user-menu">
                            <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <img src="{{ asset('assets/auth/images/user/user-md-2.jpg') }}"
                                    class="user-image rounded-circle" alt="User Image" />
                                <span class="d-none d-lg-inline-block">{{auth()->user()->name}}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-link-item" href="user-profile.html">
                                        <i class="mdi mdi-account-outline"></i>
                                        <span class="nav-text">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                   
                                </li>
                                
                                <li class="dropdown-footer">
                                    <form action="{{ route('logout') }}" method="post" id="logout-form">
                                        @csrf

                                        <a id="logout-btn" class="dropdown-link-item" href="javascript:void(0)"> <i
                                                class="mdi mdi-logout"></i> Log Out </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


        </header>

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
            <div class="content">
                <!-- Top Statistics -->
                <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-default card" style="height: 140px">
                            <div class="card-header">
                                <h2>{{$postsCount}}</h2>
                                <div class="sub-title">
                                    <span class="mr-1">Posts</span> 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-default card" style="height: 140px">
                            <div class="card-header">
                                <h2>{{$tagsCount}}</h2>
                                <div class="sub-title">
                                    <span class="mr-1">Tags</span> 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-default card" style="height: 140px">
                            <div class="card-header">
                                <h2>{{$categoriesCount}}</h2>
                                <div class="sub-title">
                                    <span class="mr-1">Categories</span> 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-default card" style="height: 140px">
                            <div class="card-header">
                                <h2>{{$usersCount}}</h2>
                                <div class="sub-title">
                                    <span class="mr-1">Users</span> 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/auth/plugins/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/auth/js/chart.js') }}"></script>
    <script src="{{ asset('assets/auth/js/map.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#logout-btn').click(function() {
                $('#logout-form').submit();
            });
        });
    </script>
@endsection
