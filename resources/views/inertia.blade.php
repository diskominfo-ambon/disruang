@extends('layouts.app')

@section('title', 'Welcome')

@section('head')
<link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/app.js') }}" defer></script>
@routes
@endsection

@section('content')
@inertia
@endsection
