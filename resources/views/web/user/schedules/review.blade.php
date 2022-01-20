@extends('web.layouts.dashlite')

@section('content')
  <!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title">
    <h3 class="title" style="line-height: 47px;">Tinjau & lengkapi kegiatan Anda?</h3>
  </div>
  <!-- .buysell-title -->

  <!-- .buysell-block -->
  <div class="buysell-block mt-5" id="app">
    <schedule-info-form 
      id="{{ $schedule->id }}"
      base-endpoint="/async/schedules"
      redirect-url="{{ route('user.home') }}"
    />
  </div>
  <!-- .buysell-block -->
</div>
@endsection


@section('head')
<script defer src="{{ asset('js/app.js') }}"></script>
@endsection
