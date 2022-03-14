@extends('web.layouts.app')



@section('head')
<style>
.alert {
  border-radius: 0;
  text-align: center;
}
.jumbroton {
  flex-direction: column;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 5rem 0;
}
.jumbroton .box {
  width: 700px;
}
.jumbroton h2 {
  text-align: center;
  font-size: 2rem;
}
.jumbroton .form__wrapper {
  border: 1px solid #E2E2E2;
  width: 850px;
  border-radius: 3px;
  position: relative;
  top: 1.6rem;
  padding: 1.6rem;
}
fieldset legend {
  font-size: .8rem;
  color: gray;
}

fieldset .form-group {
  flex: 1;
  margin-right: 1rem;
}
fieldset .form-group:last-child {
  margin-right: 0 !important;
}

fieldset .form-group .form-control {
  background-color: #F6F6F6;
}

fieldset .form-group label {
  font-size: .91rem;
  margin-bottom: .4rem;
}
fieldset .btn.btn-secondary {
  color: white !important;
  position: relative;
  bottom: .7rem;
}
fieldset .form-control__dropdown .title {
  font-size: .91rem;
  margin-bottom: .2rem;
}
fieldset .form-control__dropdown span {
  font-size: .8rem;
  color: #454545;
  margin: 0;
}
</style>
@endsection

@section('content')
<header>
  <div class="alert alert-secondary alert-b-blue alert-b">
    <div class="container">
      Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama Wabah Virus Corona, <a href="#">disini</a>.
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand text-dark" href="#">Disruang</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
        <div class="d-flex">
          <a href="" class="btn btn-outline-primary">Login</a>
        </div>
      </div>
    </div>
  </nav>
</header>


<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="jumbroton">
        <div class="box">
          <h2>Pemesanan ruangan jauh lebih menyenangkan bersama <strong>disruang</strong></h1>
        </div>

        <div class="form__wrapper">
          <form>
            <fieldset>
              <legend>Data diri pengguna</legend>
              <div class="d-flex">
                <div class="form-group">
                  <label for="">Nama lengkap</label>
                  <input type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Nomor telepon</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">08</span>
                    <input type="number" class="form-control">
                  </div>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Kegiatan pengguna</legend>
              <div class="d-flex align-items-end">
                <div class="form-group">
                  <label for="">Pilih kegiatan</label>
                  <div class="form-control form-control__dropdown">
                    <p class="title">Ruangan Darwin - Kegiatan pembangunan anak muda maluku untuk peningkatan UKM</p>
                    <span class="text-primary"># Mulai kegiatan pukul 12:00 22 Januari 2022 sampai pukul 15:00 22 Januari 2022</span>
                  </div>
                </div>
                <button class="btn btn-secondary">
                  Daftar & ikut kegiatan
                </button>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection