@extends('web.layouts.dashlite')


@section('head')
<style>
.nk-block-head-content {
    width: 100%;
}
.nk-block-head-content .nk-block-des {
    display: flex;
    justify-content: space-between;
}
.nk-block-head-content .nk-block-des form {
    position: relative;
    top: -3rem;
}
</style>
@endsection

@section('content')
<div class="nk-block-head-sub"><span>Beranda</span> </div>
<div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
        <h3 class="nk-block-title fw-normal">Semua kegiatan Anda</h3>
        <div class="nk-block-des">
            <p>Semua kegiatan yang berhasil pernah kamu buat.</p>
            <form id="form-search">
                <div class="form-group">
                    <label for="input room" class="d-block">Filter ruangan</label>
                    <select style="margin-top: -.5rem;" name="room" id="input-room" class="form-control">
                        @foreach ($rooms as $current)
                            <option value="{{ $current->id }}" {{ $current->id == $roomId ? 'selected' : '' }}>Ruangan {{ strtoupper($current->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block-between -->
<div class="nk-block nk-block-lg">
  <div class="row g-gs">
      <div class="col-md-6 col-lg-6">
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
        <div class="col-md-6 col-lg-6">
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
                          <div class="amount" style="font-size: 1rem;">
                            <p class="mb-1">{{ str($schedule->title)->limit(50) }}</p>
                            Dibuat oleh <span class="currency currency-eur">{{ $schedule->user->id === auth()->user()->id
                                    ? "Saya sendiri"
                                    : str($schedule->user->name)->limit(20)
                                }}
                                @if ($schedule->user->origin)
                                • <b>{{ str($schedule->user->origin?->title)->upper()->limit(30) }}</b>
                                @else
                                • Tidak diketahui
                                @endif
                            </span>
                          </div>
                          <div class="amount-sm mt-1">Ruangan {{ str($schedule->room->name)->upper()->limit(20) }} • Dibuat pada <span class="currency currency-usd">{{ $schedule->created_at }}</span></div>
                      </div>

                      <div class="mt-3">
                        <ul>
                            <li>Waktu mulai: {{ $schedule->started_at->locale('id-ID')->isoFormat('LLL') }}</li>
                            <li>Waktu selesai: {{ $schedule->ended_at->locale('id-ID')->isoFormat('LLL') }}</li>
                        </ul>
                      </div>
                  </div>

                  <div class="nk-wgw-actions">
                    @if ($schedule->user->id === auth()->user()->id)
                      <ul>
                          <li><a href="{{ route('user.schedules.show', $schedule) }}"><em class="icon ni ni-eye-fill"></em><span>Lihat</span></a></li>
                          <li><a href="{{ route('user.schedules.review', $schedule) }}"><em class="icon ni ni-setting"></em><span>Tinjau</span></a></li>
                          <li><a href="{{ route('exports.schedules.participants', $schedule) }}"><em class="icon ni ni-file-download"></em><span>Download</span></a></li>
                      </ul>
                    @else
                        <p class="text-center text-danger">Tidak memiliki akses</p>
                    @endif
                  </div>
                
              </div>
          </div><!-- .card -->
        </div><!-- .col -->
      @endforeach

      {{ $schedules->links('pagination::bootstrap-4') }}
  </div><!-- .row -->
</div><!-- .nk-block -->
@endsection


@section('script')

<script>
$(document).ready(function() {
    $('#input-room').on('change', () => {
        $('#form-search').submit();
    });
});
</script>
@endsection