@extends('web.layouts.dashlite')

@section('content')
<!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title">Apa yang ingin Anda usulkan?</h2>
</div>
<!-- .buysell-title -->

<!-- .buysell-block -->
<div class="buysell-block" id="content">
  <suspense>
    <room-schedule-form/>
    <template #default>
    </template>
    <template #fallback>
      <p class="text-center">Tunggu sebentar..</p>
    </template>
  </suspense>
</div>
<!-- .buysell-block -->
</div>
@endsection


@section('head')
<script defer src="{{ mix('vendor/dashlite-v2/lib/app.js') }}"></script>
@endsection
