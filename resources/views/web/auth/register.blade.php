@extends('web.layouts.app')


@section('head')
<style>
  body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url(/images/svg/blue-wall.svg);
    background-position: bottom;
    background-size: contain;
    background-repeat: no-repeat;
  }

  .form-box {
    padding: 3rem 1.3rem 1rem 1.3rem;
    border-radius: 6px;
    width: 25rem;
    background-color: white;

  }
  .subtitle {
    font-size: .9rem;
    margin-top: 1rem;
    text-align: center;
  }
  .meta p {
    font-size: .9rem;
  }

  .form-media-social {
    margin-top: 1rem;
  }

  .form-media-social .divider-text {
    font-size: 0.9rem;
    color: #8a93a7 !important;
  }

  .form-media-social .btn-media-social {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding: .5rem 1rem;
  }
  .form-media-social .btn-media-social span {
    margin-left: .6rem;
  }

  .form-media-social .btn-media-social img {
    width: 20px;
  }

  @media screen and (max-width: 760px) {
    body {
      align-items: flex-start;
    }

    .form-box {
      width: 100%;
      border-radius: 0;
      box-shadow: none !important;
    }
  }

</style>
@endsection

@section('content')
<div class="form-box shadow-sm">
  <h3 class="text-primary m-0 text-center fw-bold">disruang</h3>
  <p class="subtitle">Mendaftar untuk mendapatkan kegiatan favoritmu.</p>

  <div class="meta">
    <p>Sudah memiliki akun? <a href="{{ route('auth.login') }}" class="is-link">Login disini.</a></p>
  </div>
  <form method="post" action="{{ route('auth.register.store') }}">
    @csrf
    <div class="form-group">
      <label class="form-label" for="name">Nama lengkap</label>
      <input type="text" autocomplete="off" placeholder="Nama lengkap Anda" value="{{ old("name") }}" autofocus class="form-control form-control-underline" name="name" id="name"/>
      @error('name')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="form-label" for="username">Username</label>
      <input type="text" autocomplete="off" placeholder="Username Anda" value="{{ old("username") }}" autofocus class="form-control form-control-underline" name="username" id="username"/>
      @error('username')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
        <label class="form-label" for="phone_number">Nomor telepon</label>
        <input type="text" autocomplete="off" placeholder="Nomor telepon Anda" value="{{ old("phone_number") }}" autofocus class="form-control form-control-underline" name="phone_number" id="phone_number"/>
        @error('phone_number')
        <span class="error-text">{{ $message }}</span>
        @enderror
      </div>
    <div class="form-group">
      <label class="form-label" for="email">Alamat email</label>
      <input type="email" autocomplete="off" placeholder="Alamat email Anda" value="{{ old("email") }}" autofocus class="form-control form-control-underline" name="email" id="email"/>
      @error('email')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="form-label" for="password">Kata sandi</label>
      <input type="password" autocomplete="off" placeholder="Kata sandi"  autofocus class="form-control form-control-underline" name="password" id="password"/>
      @error('password')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="form-label" for="password_confirmation">Konfirmasi kata sandi</label>
      <input type="password" autocomplete="off" placeholder="Konfirmasi kata sandi"  autofocus class="form-control form-control-underline" name="password_confirmation" id="password_confirmation"/>
      @error('password_confirmation')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group d-flex align-items-center mt-3">
      <button class="btn btn-primary text-white">Buat akun pengguna</button>
    </div>
  </form>

  {{-- <div class="form-media-social">
    <p class="divider-text">Atau</p>
    <a class="btn btn-secondary btn-media-social" href="#">
      <img src="{{ asset('images/google.webp') }}"/>
      <span>
        Lanjutkan dengan Google
      </span>
    </a>
  </div> --}}
</div>
@endsection
