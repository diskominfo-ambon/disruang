@extends('web.layouts.admin')

@section('content')
<div class="nk-block-head-sub"><span>Beranda</span> </div>
<div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
        <h3 class="nk-block-title fw-normal">Semua kebutuhan monitor</h3>
        <div class="nk-block-des">
            <p>Beberapa kebutuhan monitor penggunaan data yang pernah dibuat.</p>
        </div>
    </div>
</div><!-- .nk-block-between -->
<div class="nk-block nk-block-lg">
  <div class="row g-gs">
    <div class="col-md-6 col-lg-4">
        <div class="card card-bordered is-dark">
            <div class="nk-wgw">
                <div class="nk-wgw-inner">
                    <a class="nk-wgw-name" href="html/crypto/wallet-bitcoin.html">
                        <div class="nk-wgw-icon is-default">
                            <em class="icon ni ni-ticket-fill"></em>
                        </div>
                        <h5 class="nk-wgw-title title">Jumlah Kegiatan</h5>
                    </a>
                    <div class="nk-wgw-balance">
                        <div class="amount">{{ $schedule->all->count() }}</div>
                        <div class="amount-sm">Semua jumlah kegiatan terkonfirmasi</div>
                    </div>
                </div>
                <div class="nk-wgw-more dropdown">
                    <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                        <ul class="link-list-plain sm">
                            <li><a href="#">Download</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- .card -->
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card card-bordered">
          <div class="nk-wgw">
              <div class="nk-wgw-inner">
                  <a class="nk-wgw-name" href="#">
                      <div class="nk-wgw-icon">
                          <em class="icon ni ni-user-fill-c"></em>
                      </div>
                      <h5 class="nk-wgw-title title">Jumlah Administrator</h5>
                  </a>
                  <div class="nk-wgw-balance">
                      <div class="amount">{{ $superUsersCount }}</div>
                      <div class="amount-sm">Semua jumlah administrator disruang</div>
                  </div>
              </div>
              <div class="nk-wgw-more dropdown">
                  <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                  <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                      <ul class="link-list-plain sm">
                          <li><a href="#">Download</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div><!-- .card -->
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card card-bordered">
          <div class="nk-wgw">
              <div class="nk-wgw-inner">
                  <a class="nk-wgw-name" href="html/crypto/wallet-bitcoin.html">
                      <div class="nk-wgw-icon">
                          <em class="icon ni ni-users-fill"></em>
                      </div>
                      <h5 class="nk-wgw-title title">Jumlah Tamu</h5>
                  </a>
                  <div class="nk-wgw-balance">
                      <div class="amount">{{ $usersCount }}</div>
                      <div class="amount-sm">Semua jumlah tamu pada disruang</div>
                  </div>
              </div>
              <div class="nk-wgw-more dropdown">
                  <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                  <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                      <ul class="link-list-plain sm">
                          <li><a href="#">Download</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div><!-- .card -->
    </div>
  </div>

  <div class="row my-5">
    <div class="col-12">
      <div class="nk-block-head-sm mb-1">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title title">Semua kegiatan hari ini</h5>
            <p>20 jadwal kegiatan hari ini yang telah terkonfirmasi.</p>
        </div>
      </div>
      <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Kegiatan</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Waktu mulai/akhir</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Dibuat oleh</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Dibuat pada</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
                        <div class="nk-tb-col tb-col-lg"></div>
                    </div><!-- .nk-tb-item -->
                    @foreach ($schedule->days as $day)
                      <div class="nk-tb-item">
                        <div class="nk-tb-col tb-col-mb">
                          <span class="tb-amount">{{ $day->title }}</span>
                          <span>Ruangan {{ strtoupper($day->room->name)}}</span>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                          <span class="badge badge-dim d-block badge-primary">{{ $day->started_at->isoFormat('LLL') }}</span>
                          <span class="badge badge-dim d-block badge-secondary mt-1">{{ $day->ended_at->isoFormat('LLL') }}</span>
                        </div>
                        <div class="nk-tb-col">
                            <a href="html/user-details-regular.html">
                                <div class="user-card">
                                    <div class="user-avatar bg-primary">
                                      <em class="icon ni ni-user-fill"></em>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $day->user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span>{{ str($day->user->email) }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                          <span class="tb-amount">{{ $day->created_at }}</span>
                        </div>
                          <div class="nk-tb-col tb-col-md">
                              <span class="tb-status text-success">Aktif</span>
                          </div>
                          <div class="nk-tb-col nk-tb-col-tools">
                          <a href="{{ route('admin.schedules.show', $day) }}" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="tooltip" title="Lihat kegiatan"><em class="icon ni ni-eye-fill"></em></a>
                          </div>
                      </div><!-- .nk-tb-item -->
                    @endforeach
                </div><!-- .nk-tb-list -->
            </div><!-- .card-inner -->

        </div><!-- .card-inner-group -->
    </div>
    </div>
  </div>
  <div class="row my-5">
    <div class="col-12">
      <div class="nk-block-head-sm mb-1">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title title">Semua kegiatan 1 minggu</h5>
            <p>20 jadwal kegiatan minggu ini yang telah terkonfirmasi.</p>
        </div>
      </div>
      <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Kegiatan</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Waktu mulai/akhir</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Dibuat oleh</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Dibuat pada</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
                        <div class="nk-tb-col tb-col-lg"></div>
                    </div><!-- .nk-tb-item -->
                    @foreach ($schedule->weeks as $week)
                    <div class="nk-tb-item">
                      <div class="nk-tb-col tb-col-mb">
                        <span class="tb-amount">{{ $week->title }}</span>
                        <span>Ruangan {{ strtoupper($week->room->name)}}</span>
                      </div>
                      <div class="nk-tb-col tb-col-md">
                        <span class="badge badge-dim d-block badge-primary">{{ $week->started_at->isoFormat('LLL') }}</span>
                        <span class="badge badge-dim d-block badge-secondary mt-1">{{ $week->ended_at->isoFormat('LLL') }}</span>
                      </div>
                      <div class="nk-tb-col">
                          <a href="html/user-details-regular.html">
                              <div class="user-card">
                                  <div class="user-avatar bg-primary">
                                    <em class="icon ni ni-user-fill"></em>
                                  </div>
                                  <div class="user-info">
                                      <span class="tb-lead">{{ $week->user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                      <span>{{ str($week->user->email) }}</span>
                                  </div>
                              </div>
                          </a>
                      </div>
                      <div class="nk-tb-col tb-col-lg">
                        <span class="tb-amount">{{ $week->created_at }}</span>
                      </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-status text-success">Aktif</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-tools">
                          <a href="{{ route('admin.schedules.show', $week) }}" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="tooltip" title="Lihat kegiatan"><em class="icon ni ni-eye-fill"></em></a>
                        </div>
                    </div><!-- .nk-tb-item -->
                    @endforeach
                </div><!-- .nk-tb-list -->
            </div><!-- .card-inner -->

        </div><!-- .card-inner-group -->
    </div>
    </div>
  </div>
</div><!-- .nk-block -->
@endsection
