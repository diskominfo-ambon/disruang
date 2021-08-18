@extends('web.layouts.admin')

@section('content')
<!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title"><em class="icon ni ni-user-add"></em> Tambahkan admin?</h2>
</div>
<!-- .buysell-title -->

<!-- .buysell-block -->
<div class="buysell-block">
  <form class="buysell-form" action="{{ route('admin.d.store') }}" method="post">

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
          <label class="form-label">Pilih Akses</label>
      </div>
      <div class="form-pm-group">
          <ul class="buysell-pm-list">
              <li class="buysell-pm-item">
                  <input class="buysell-pm-control" value="kominfo" type="radio" name="permission" id="pm-paypal" />
                  <label class="buysell-pm-label" for="pm-paypal">
                    <div>
                      <span class="pm-name">Komfinfo</span>
                      <p class="text-gray">Dapat melakukan super akses</p>
                    </div>
                      <span class="pm-icon"><em class="icon ni ni-user-fill-c"></em></span>
                  </label>
              </li>
              <li class="buysell-pm-item">
                  <input class="buysell-pm-control" value="humas" type="radio" name="permission" id="pm-bank" />
                  <label class="buysell-pm-label" for="pm-bank">
                      <div>
                        <span class="pm-name">Humas</span>
                        <p class="text-gray">Hanya dapat mengelolah kegiatan</p>
                      </div>
                      <span class="pm-icon"><em class="icon ni ni-account-setting-fill"></em></span>
                  </label>
              </li>
              <li class="buysell-pm-item">
                  <input class="buysell-pm-control" value="protocol" type="radio" name="permission" id="pm-card" />
                  <label class="buysell-pm-label" for="pm-card">
                      <div>
                        <span class="pm-name">Protokol</span>
                        <p class="text-gray">Hanya dapat memantau kegiatan</p>
                      </div>
                      <span class="pm-icon"><em class="icon ni ni-user-list-fill"></em></span>
                  </label>
              </li>
          </ul>
      </div>

      @error('permission')
      <span class="error-text">{{ $message }}</span>
      @enderror
  </div><!-- .buysell-field -->

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
