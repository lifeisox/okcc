@extends('admin.layouts.master')

@section('content')
<div style="margin: -15px -45px;">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron jumbotron-fluid" style="background-color: #2196f3; color: whitesmoke;">
        <div class="container">
            <p><h1>{{ trans('admin.landing.title_officer') }}</h1></p>
            <p class="lead text-justify">{{ trans('admin.landing.message_officer') }}</p>
            <p style="color: orange">{{ trans('admin.landing.passage_officer') }}</p>
        </div>
    </div>
</div>
@endsection
