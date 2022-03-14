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
    width: 30rem;
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

  .form-group-label {
    font-size: .9rem;
    margin: 1.2rem 0;
  }

  .form-group-text {
    margin-top: .6rem;
    display: block;
    font-size: .8rem;
  }

  .form-group-text::before {
    content: '* ';
    display: inline-block;
    color: red;
  }
  .link-navigation li {
    flex: 1;
    text-align: center;
    padding: .8rem 0;
    border-bottom: 3px solid gray;
    
  }

  .link-navigation li.active {
    border-bottom: 3px solid dodgerblue;
  }

  .link-navigation li.active a {
    color: dodgerblue;
  }

  .link-navigation li a {
    color: gray;
    text-decoration: none;
  }
  .link-navigation {
    list-style: none;
    display: flex;
    padding: 0;
    margin-bottom: 2rem;
  }
  .logo img {
    width: 60px;
  }
  .logo {
    text-align: center;
    margin-bottom: .6rem;
  }
</style>
@endsection

@section('content')

<div>
  <div class="form-box shadow-sm">
  @if (session('message'))
  <div class="alert alert-info my-4 alert-sm">{{ session('message') }}</div>
  @endif
    <div class="logo">
      <img src="{{ asset('images/logo-pemkot.png') }}" alt="">
    </div>
    <h3 class="text-primary m-0 text-center fw-bold">disruang</h3>
    <p class="subtitle">Mendaftar untuk mendapatkan kegiatan favoritmu.</p>

    <div class="meta">
      <p>Sudah memiliki akun? <a href="{{ route('auth.login') }}" class="is-link">Login disini.</a></p>
    </div>
    <ul class="link-navigation">
      <li class="{{ request()->get('in') != 'employee' ? 'active' : '' }}">
        <a href="{{ route('auth.register') }}">Daftar untuk Tamu</a>
      </li>
      <li class="{{ request()->get('in') == 'employee' ? 'active' : ''}}">
        <a href="?in=employee">Daftar untuk OPD</a>
      </li>
    </ul>
    @if (request()->get('in') == 'employee')
      @include('web/auth/register/employee')
    @else
      @include('web/auth/register/user')
    @endif

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
</div>
@endsection
