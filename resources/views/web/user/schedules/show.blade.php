@extends('web.layouts.dashlite')


@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kumpulan materi kegiatan {{ $schedule->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @forelse($schedule->attachments as $attachment)
        <ul class="list-group">
          <li class="list-group-item">
            <div class="d-flex align-items-center justify-content-between">
              <div style="flex: 1;">
                {{ str($attachment->original_filename)->limit(30) }}
              </div>
              <a class="fw-bold" href="{{ asset('storage/'. $attachment->path) }}" download>Download</a>
            </div>
          </li>
        </ul>
        @empty
        <p class="text-center">Tidak ada berkas materi</p>
        @endforelse
      </div>
      
    </div>
  </div>
</div>

<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between g-3">
      <div class="nk-block-head-content">
          <h4 class="nk-block-title">{{ str($schedule->title)->limit(50) }}</h4>
          <div class="nk-block-des text-soft">
              <p class="m-0"><b>{{ $schedule->user->name }}</b> • {{ $schedule->created_at }} • Kamu memiliki jumlah <span class="text-base">{{ $schedule->participants->count() }}</span> tamu kegiatan.</p>
          </div>
      </div>
      <div class="nk-block-head-content">
          <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#exampleModal">
            <em class="icon ni ni-eye mr-1"></em> Materi
          </button>
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
                      <div class="nk-tb-col tb-col-lg"><span>Status jabatan</span></div>
                  </div>
                  @foreach ($participants as $participant)
                   
                    @if ($participant->isEmployee)
                    <div class="nk-tb-item">
                        <div class="nk-tb-col nk-tb-col-check">
                            {{ $loop->iteration }}
                        </div>
                        <div class="nk-tb-col">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                    <em class="icon ni ni-user-fill"></em>
                                </div>
                                <div class="user-info">
                                    <span class="tb-lead">{{ $participant->employee->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    <span>{{ str($participant->employee->email) }} - {{ $participant->employee->nip }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-mb">
                            <span class="tb-lead-sub">-</span>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-status text-success fw-bold">ASN</span>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                          <span class="tb-lead-sub">{{ $participant->employee->job_position }}</span>
                        </div>
                    </div>
                    @else
                    
                    <!-- .nk-tb-item -->
                    <div class="nk-tb-item">
                        <div class="nk-tb-col nk-tb-col-check">
                            {{ $loop->iteration }}
                        </div>
                        <div class="nk-tb-col">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                  <em class="icon ni ni-user-fill"></em>
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
                          <span class="tb-status text-info fw-bold">Umum</span>
                          
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                          <span class="tb-lead-sub">{{ $participant->origin ?? ''}} {{ $participant->origin_job_title ?? '' }}</span>
                        </div>

                    </div>
                    <!-- .nk-tb-item -->
                    @endif
                  @endforeach
              </div>
          </div><!-- .card-inner -->
          <div class="card-inner">
            {{ $participants->links('pagination::bootstrap-4') }}
          </div><!-- .card-inner -->
      </div><!-- .card-inner-group -->
  </div><!-- .card -->
@endsection
