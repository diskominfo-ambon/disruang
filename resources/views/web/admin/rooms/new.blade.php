@extends('web.layouts.admin')

@section('content')
<!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title"><em class="icon ni ni-building-fill"></em> Tambahkan ruangan?</h2>
</div>
<!-- .buysell-title -->

<!-- .buysell-block -->
<div class="buysell-block">
  <form class="buysell-form" action="{{ route('admin.rooms.store') }}" method="post">

    @csrf

    <div class="buysell-field form-group">
      <div class="form-label-group">
        <label for="name" class="form-label">
          Nama ruangan
        </label>
      </div>
      <div class="form-control-group">
        <input type="text" value="{{ old('name') }}" placeholder="Nama ruangan.." id="name" name="name" class="form-control form-control-lg form-control-number">
      </div>
      @error('name')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>



    <div class="buysell-field form-action">
      <button class="btn btn-lg btn-block btn-primary">
      Tambahkan ruangan
      </button>
    </div>
  </form>
</div>
<!-- .buysell-block -->
</div>
@endsection
