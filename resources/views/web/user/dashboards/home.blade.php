@extends('web.layouts.dashlite')

@section('content')
<div class="nk-block-head-sub"><span>Beranda</span> </div>
<div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
        <h3 class="nk-block-title fw-normal">Semua kegiatan Anda</h3>
        <div class="nk-block-des">
            <p>Semua kegiatan yang berhasil pernah kamu buat.</p>
        </div>
    </div>
</div><!-- .nk-block-between -->
<div class="nk-block nk-block-lg">
  <div class="row g-gs">
      <div class="col-md-6 col-lg-4">
          <div class="card card-bordered dashed h-100">
              <div class="nk-wgw-add">
                  <div class="nk-wgw-inner">
                      <a href="{{ route('user.schedules.new') }}">
                          <div class="add-icon">
                              <em class="icon ni ni-plus"></em>
                          </div>
                          <h6 class="title">Tambahkan kegiatan baru</h6>
                      </a>
                      <span class="sub-text">
                        Anda dapat menambahkan kegiatan dengan melakukan pemohona izin pengadaan kegiatan.
                      </span>
                  </div>
              </div>
          </div><!-- .card -->
      </div><!-- .col -->

      @foreach($schedules as $schedule)
        <div class="col-md-6 col-lg-4">
          <div class="card card-bordered">
              <div class="nk-wgw">
                  <div class="nk-wgw-inner">
                      <a class="nk-wgw-name" href="{{ route('user.schedules.show', $schedule) }}">
                          <div class="nk-wgw-icon bg-primary">
                            <em class="icon ni ni-users-fill"></em>
                          </div>
                          <h5 class="nk-wgw-title title">{{ $schedule->participants->count() }} pengguna bergabung</h5>
                      </a>
                      <div class="nk-wgw-balance">
                          <div class="amount" style="font-size: 1rem;">{{ str($schedule->title)->limit(50) }} • <span class="currency currency-eur">Saya</span></div>
                          <div class="amount-sm mt-1">{{ str($schedule->room->name)->title()->limit(20) }} • <span class="currency currency-usd">{{ $schedule->created_at }}</span></div>
                      </div>
                  </div>
                  <div class="nk-wgw-actions">
                      <ul>
                          <li><a href="{{ route('user.schedules.show', $schedule) }}"><em class="icon ni ni-eye-fill"></em><span>Lihat</span></a></li>
                          <li><a href="{{ route('exports.schedules.participants', $schedule) }}"><em class="icon ni ni-file-download"></em><span>Download</span></a></li>
                      </ul>
                  </div>
              </div>
          </div><!-- .card -->
        </div><!-- .col -->
      @endforeach
  </div><!-- .row -->
</div><!-- .nk-block -->
@endsection
