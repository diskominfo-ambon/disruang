<form method="post" action="{{ route('auth.employee.register.store') }}">
    @csrf

    <div class="form-group-label">1. Informasi pengguna</div>
    <div class="form-group">
      <label class="form-label" for="origin">OPD pengguna</label>
      <select name="origin_id" class="form-control form-control-underline" id="origin">
        <option value="">-- Pilih OPD --</option>
        @foreach ($origins as $origin)
        <option value="{{ $origin->id }}">{{ strtoupper($origin->title) }}</option>
        @endforeach
      </select>

      @error('origin_id')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="form-label" for="job_position">Status jabatan</label>
      <input type="text" autocomplete="off" placeholder="Status jabatan" value="{{ old('job_position') }}" autofocus class="form-control form-control-underline" name="job_position" id="job_position"/>
      @error('job_position')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="form-label" for="email">Alamat email</label>
      <input type="email" autocomplete="off" placeholder="Alamat email Anda" value="{{ old('email') }}" autofocus class="form-control form-control-underline" name="email" id="email"/>
      
      @error('email')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="form-label" for="phone_number">Nomor telepon</label>
      <input type="text" autocomplete="off" placeholder="Nomor telepon Anda" value="{{ old('phone_number') }}" autofocus class="form-control form-control-underline" name="phone_number" id="phone_number"/>
      @error('phone_number')
      <span class="error-text">{{ $message }}</span>
      @enderror
    </div>
    
    <div class="form-group-label">2. Informasi akun</div>
    <div class="form-group">
      <label class="form-label" for="username">Username</label>
      <input type="text" autocomplete="off" placeholder="Username Anda" value="{{ old('username') }}" autofocus class="form-control form-control-underline" name="username" id="username"/>
      @error('username')
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
      <button class="btn btn-primary text-white">Buat akun OPD</button>
    </div>
  </form>