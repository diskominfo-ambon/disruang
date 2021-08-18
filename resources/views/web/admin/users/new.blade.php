@extends('web.layouts.admin')

@section('content')
<!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title"><em class="icon ni ni-user"></em> Tambahkan tamu pengguna?</h2>
</div>
<!-- .buysell-title -->

<!-- .buysell-block -->
<div class="buysell-block">
  <form class="buysell-form" action="{{ route('admin.users.store') }}" method="post">

    @csrf

    <div class="buysell-field form-group">
      <div class="form-label-group">
        <label for="name" class="form-label">
          Nama pengguna
        </label>
      </div>
      <div class="form-control-group">
        <input type="text" value="{{ old('name') }}" placeholder="Nama pengguna.." id="name" name="name" class="form-control form-control-lg form-control-number">
      </div>
      @error('name')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>

    <div class="buysell-field form-group">
      <div class="form-label-group">
        <label for="phone_number" class="form-label">
          Nomor telepon
        </label>
      </div>
      <div class="form-control-group">
        <input type="number" value="{{ old('phone_number') }}" placeholder="Alamat email pengguna.." id="phone_number" name="phone_number" class="form-control form-control-lg form-control-number">
      </div>
      @error('phone_number')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>

    <div class="buysell-field form-group">
      <div class="form-label-group">
        <label for="email" class="form-label">
          Alamat email
        </label>
      </div>
      <div class="form-control-group">
        <input type="email" value="{{ old('email') }}" placeholder="Alamat email pengguna.." id="email" name="email" class="form-control form-control-lg form-control-number">
      </div>
      @error('email')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>

    <div class="buysell-field form-group">
      <div class="form-label-group">
        <label for="password" class="form-label">
          Kata sandi
        </label>
      </div>
      <div class="form-control-group">
        <input type="password" placeholder="Kata sandi pengguna.." id="password" name="password" class="form-control form-control-lg form-control-number">
      </div>
      @error('password')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>

    <div class="buysell-field form-group">
      <div class="form-label-group">
        <label for="password_confirmation" class="form-label">
          Konfirmasi kata sandi
        </label>
      </div>
      <div class="form-control-group">
        <input type="password" placeholder="Konfirmasi kata sandi pengguna.." id="password_confirmation" name="password_confirmation" class="form-control form-control-lg form-control-number">
      </div>
      @error('password_confirmation')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>



    <div class="buysell-field form-action">
      <button class="btn btn-lg btn-block btn-primary">
      Tambahkan pengguna
      </button>
    </div>
  </form>
</div>
<!-- .buysell-block -->
</div>
@endsection
