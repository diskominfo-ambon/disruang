@extends('web::layouts.app')

@section('title', 'Welcome')

@section('head')
<script src="{{ mix('/js/app.js') }}" defer></script>
@routes
@endsection

@section('content')
@inertia
@endsection
