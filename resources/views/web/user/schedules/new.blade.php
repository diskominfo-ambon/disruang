@extends('web.layouts.dashlite')

@section('content')
  <!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title">Apa yang ingin Anda usulkan?</h2>
  </div>
  <!-- .buysell-title -->

  <!-- .buysell-block -->
  <div class="buysell-block mt-5" id="app">
    <schedule-form/>
  </div>
  <!-- .buysell-block -->
</div>
@endsection


@section('head')
<script defer src="{{ asset('js/app.js') }}"></script>
@endsection
