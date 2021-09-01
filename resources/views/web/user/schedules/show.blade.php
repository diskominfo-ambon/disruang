@extends('web.layouts.dashlite')


@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between g-3">
      <div class="nk-block-head-content">
          <h4 class="nk-block-title">{{ str($schedule->title)->limit(50) }}</h4>
          <div class="nk-block-des text-soft">
              <p class="m-0"><b>{{ $schedule->user->name }}</b> • {{ $schedule->created_at }} • Kamu memiliki jumlah <span class="text-base">{{ $schedule->participants->count() }}</span> tamu kegiatan.</p>
          </div>
      </div>
      <div class="nk-block-head-content">
          <a href="{{ route('exports.schedules.participants', $schedule) }}" class="btn btn-primary d-none d-sm-inline-flex"><em class="icon ni ni-download-cloud"></em><span>Download</span></a>
        </div>
      </div>
  </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
  <div class="card card-bordered card-stretch">
      <div class="card-inner-group">
          <div class="card-inner position-relative">
            <form>
              <div class="card-title-group">
                <div class="card-tools">
                  <input name="keyword" value="{{ $keyword }}" type="text" class="form-control border-transparent form-focus-none" autofocus style="font-size: 1rem;" placeholder="Telusuri nama tamu..">
                </div>
                <div class="card-tools mr-n1">
                    <ul class="btn-toolbar gx-1">
                        <li>
                            <button class="btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </li>
                        <li class="btn-toolbar-sep"></li>
                        <li>
                            <div class="dropdown">
                                <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                    <em class="icon ni ni-setting"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                    <ul class="link-check">
                                        <li><span>Urutkan</span></li>
                                        <li class="active"><a href="#">Terbaru</a></li>
                                        <li><a href="#">Terlama</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card-tools -->
              </div><!-- .card-title-group -->
            </form>
          </div><!-- .card-inner -->
          <div class="card-inner p-0">
              <div class="nk-tb-list nk-tb-ulist">
                  <div class="nk-tb-item nk-tb-head">
                      <div class="nk-tb-col"><span>No</span></div>
                      <div class="nk-tb-col tb-col-mb"><span>Nama</span></div>
                      <div class="nk-tb-col tb-col-lg"><span>Nomor nomor telepon</span></div>
                      <div class="nk-tb-col tb-col-md"><span>ASN?</span></div>
                      <div class="nk-tb-col tb-col-lg"><span>Asal instansi</span></div>
                      <div class="nk-tb-col tb-col-lg"><span>Status jabatan</span></div>
                      <div class="nk-tb-col nk-tb-col-tools">&nbsp;</div>
                  </div>

                  @foreach ($participants as $participant)
                    <!-- .nk-tb-item -->
                    <div class="nk-tb-item">
                        <div class="nk-tb-col nk-tb-col-check">
                            {{ $loop->iteration }}
                        </div>
                        <div class="nk-tb-col">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                    <span>AB</span>
                                </div>
                                <div class="user-info">
                                    <span class="tb-lead">{{ str($participant->name)->limit(20) }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    <span>{{ str($participant->email) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-mb">
                            <span class="tb-lead-sub">{{ $participant->phone_number }}</span>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                          @if ($participant->isEmployee)
                            <span class="tb-status text-success">ASN</span>
                          @else
                            <span class="tb-status text-info">Umum</span>
                          @endif
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                          <span class="tb-lead-sub">{{ $participant->origin ?? '-'}}</span>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                          <span class="tb-lead-sub">{{ $participant->origin_job_title ?? '-' }}</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-tools">
                          <ul class="nk-tb-actions gx-1">
                            <li>
                              <a href="html/kyc-details-regular.html" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="left" title="Lihat informasi">
                                <em class="icon ni ni-eye-fill"></em>
                                </a>
                            </li>
                          </ul>
                        </div>
                    </div>
                    <!-- .nk-tb-item -->
                  @endforeach
              </div>
          </div><!-- .card-inner -->
          <div class="card-inner">
            {{ $participants->links('pagination::bootstrap-4') }}
          </div><!-- .card-inner -->
      </div><!-- .card-inner-group -->
  </div><!-- .card -->
@endsection
