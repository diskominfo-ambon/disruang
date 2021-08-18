@extends('web.layouts.admin')


@section('content')

<!-- .nk-block-head-content -->
<div class="row">
  <div class="col-12">
    <div class="nk-block-head-content">
      <h3 class="nk-block-title page-title">💫 Semua kegiatan terkonfirmasi</h3>
      <div class="nk-block-des text-soft">
          <p>Terdapat {{ $schedules->total() }} jumlah kegiatan yang berhasil dikonfirmasi.</p>
      </div>
    </div>

    {{-- search --}}
    <div class="card card-bordered mt-4">
      <div class="card-body p-1">
        <form>
          <div class="nk-block-between-md">
            <div class="nk-block-between" style="flex:1;">
              <input type="text" name="keyword" value="{{ request()->get('keyword', '') }}" class="form-control" style="font-size: .90rem; border: 0; flex:1;" placeholder="Telusuri nama kegiatan..">
              <button class="btn">
                <em class="icon ni ni-search"></em>
              </button>
            </div>
            <div class="nk-block-between">
              <div class="form-control-wrap" data-toggle="tooltip" title="Telusuri ruangan">
                  <select class="form-select" data-search="on" name="room">
                      <option value="*">Semua ruangan</option>
                      @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ request()->get('room', '*') == $room->id ? 'selected' : '' }}>Ruangan {{ strtoupper($room->name) }}</option>
                      @endforeach
                  </select>
              </div>

              <div data-toggle="tooltip" title="Telusuri tanggal">
                <div class="dropdown">
                  <button class="btn ml-1 dropdown-toggle" data-toggle="dropdown">
                    <em class="icon ni ni-calendar-fill"></em>
                  </button>

                  <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                    <div class="dropdown-head">
                      <span class="sub-title dropdown-title"><b>Telusuri bedasarkan tanggal</b></span>
                    </div>
                    <div class="dropdown-body p-2">
                      <input type="text" value="{{ request()->get('date', '') }}" name="date" class="form-control form-control-lg date-picker" placeholder="Tanggal saat ini">
                    </div>
                    <div class="dropdown-foot">
                      <a class="" href="#">Simpan pencarian</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- end --}}

    <div class="card card-bordered card-stretch mt-3">
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
                  @foreach ($schedules as $schedule)
                  <div class="nk-tb-item">
                    <div class="nk-tb-col tb-col-mb">
                      <span class="tb-amount">{{ $schedule->title }}</span>
                      <span>Ruangan {{ strtoupper($schedule->room->name)}}</span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                      <span class="badge badge-dim d-block badge-primary">{{ $schedule->started_at->isoFormat('LLL') }}</span>
                      <span class="badge badge-dim d-block badge-secondary mt-1">{{ $schedule->ended_at->isoFormat('LLL') }}</span>
                    </div>
                    <div class="nk-tb-col">
                        <a href="html/user-details-regular.html">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                  <em class="icon ni ni-user-fill"></em>
                                </div>
                                <div class="user-info">
                                    <span class="tb-lead">{{ $schedule->user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    <span>{{ str($schedule->user->email) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                      <span class="tb-amount">{{ $schedule->created_at }}</span>
                    </div>
                      <div class="nk-tb-col tb-col-md">
                          <span class="tb-status text-success">Aktif</span>
                      </div>
                      <div class="nk-tb-col nk-tb-col-tools">
                        <a href="{{ route('admin.schedules.show', $schedule) }}" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="tooltip" title="Lihat kegiatan"><em class="icon ni ni-eye-fill"></em></a>
                      </div>
                  </div><!-- .nk-tb-item -->
                  @endforeach
              </div><!-- .nk-tb-list -->
          </div><!-- .card-inner -->

          <!-- .card-inner-group -->
          @if ($schedules->total() > 20)
          <div class="card-inner">
            <div class="g">
              {{ $schedules->links('pagination::bootstrap-4') }}
              <!-- .pagination -->
          </div>
          @endif
      </div>
    </div>
  </div>
  </div>
</div>
@endsection
