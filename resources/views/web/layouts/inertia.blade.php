@extends('web::layouts.app')

@section('title', 'Welcome')

@section('head')
<script src="{{ mix('/js/app.js') }}" defer></script>
{{-- @routes --}}
<script>
  function route() {

  }
</script>
@endsection

@section('content')
@inertia
@endsection
