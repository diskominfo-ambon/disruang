@extends('web::layouts.app')

@section('title', 'Welcome')

@section('head')
<script src="{{ mix('/js/app.js') }}" defer></script>
@routes
@endsection

@section('content')
<x-alert>
  Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama wabah virus <a class="is-link">Corona.</a>
</x-alert>
<x-navbar/>

@inertia
@endsection
