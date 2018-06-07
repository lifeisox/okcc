@extends('admin.layouts.master')

@section('content')
<div style="margin: -15px -45px;">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron jumbotron-fluid pt-3 pb-2 my-0" style="background-color: #2196f3; color: whitesmoke;">
        <div class="container text-center">
            <p><span style="font-size: 3.6rem; font-weight: 900">{{ config('app.name', 'Application Name') }} </span><span  style="font-size: 2.5rem; font-weight: 700">for Admin</span></p>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid my-0" style="background-color:#002550; color: whitesmoke; min-height: calc(100vh - 236px)">
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.sidebar').addClass( "toggled" );
    });
</script>
@endsection
