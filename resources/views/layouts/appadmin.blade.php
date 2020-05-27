@extends('layouts.app')

@section('content')
<div id="wrapper">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <br>
            @yield('content_admin')
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
@endsection