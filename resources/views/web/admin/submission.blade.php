@extends('web.layouts.admin')


@section('content')
<div class="nk-block-head">
  <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
          <h3 class="nk-block-title fw-normal">Semua permohonan kegiatan pengguna</h3>
        </div>
    </div>
</div>

<!-- show validation message schedule rejected -->
@error('message')
<div class="alert alert-danger">
    Pesan alasan penolakan {{ $message }}
</div>
@enderror

<!-- .nav-tabs -->
<ul class="nk-nav nav nav-tabs">
  <li class="nav-item">
      <a class="nav-link @if ($order === 'pending') active current-page @endif" href="{{ route('admin.submissions') }}?order=pending">Menunggu</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.submissions') }}?order=reject">Ditolak</a>
  </li>
</ul>
<!-- end -->
@php
$currentItr = null;
@endphp
<div class="nk-block nk-block-sm">
  @forelse ( $schedules as $key => $schedule )
    @if (
        !is_null($currentItr) &&
        $schedule->created_at
          ->isSameDay($currentItr->created_at)
        )
        <!-- .nk-tranx-item -->
          <div class="tranx-item">
              <div class="tranx-col">
                  <div class="tranx-info">
                      <div class="tranx-badge">
                          <span class="tranx-icon icon ni ni-ticket-fill"></span>
                      </div>
                      <div class="tranx-data">
                        <div class="tranx-label">{{ str($schedule->title)->limit(70) }}</div>
                        <div class="tranx-date mb-1" style="font-size: .90rem;">{{ $schedule->desc ?: 'Tidak memiliki deskripsi' }}</div>
                        <div class="tranx-date">Ruangan {{ str($schedule->room->name)->upper() }} • Oleh pengguna {{ $schedule->user->name }} • {{ $schedule->created_at }}</div>
                        <div class="mt-1">
                          <span class="d-inline-block badge badge-dim badge-primary">{{ $schedule->started_at->isoFormat('LLL') }}</span>
                          <span class="d-inline-block position-relative" style="top:.2rem;">
                            <em class="icon ni ni-caret-right-fill"></em>
                          </span>
                          <span class="d-inline-block badge badge-dim badge-secondary">{{ $schedule->ended_at->isoFormat('LLL') }}</span>
                        </div>
                      </div>
                  </div>
              </div>
              @if ($order === 'pending')
              <div class="tranx-col">
                <form action="{{ route('admin.submissions.update', $schedule) }}?order=confirm" method="POST">
                  @csrf
                  @method('PUT')
                  <button onclick="return confirm('Yakin ingin konfirmasi kegiatan ini?')" data-toggle="tooltip" data-placement="left" title="Konfirmasi kegiatan ini?" class="btn btn-sm btn-primary text-white mb-1">
                    <em class="icon ni ni-check"></em>
                  </button>
                </form>

                <button data-action="{{ route('admin.submissions.update', $schedule) }}?order=reject"  data-toggle="tooltip" data-placement="left" title="Hapus kegiatan ini?" class="btn btn-sm btn-outline-danger btn-schedule__rejected">
                  <em class="icon ni ni-cross"></em>
                </button>
              </div>
              @endif
          </div>
        <!-- .nk-tranx-item -->


    @else
      @if ($key > 0)
        </div>
        <!-- close tag the group .nk-tranx-item by date -->
      @endif

      <h6 class="lead-text text-soft">Dibuat pada {{ $schedule->created_at }}</h6>
      <div class="tranx-list tranx-list-stretch card card-bordered">
        <!-- .nk-tranx-item -->
        <div class="tranx-item">
          <div class="tranx-col">
              <div class="tranx-info">
                  <div class="tranx-badge">
                    <span class="tranx-icon icon ni ni-ticket-fill"></span>
                  </div>
                  <div class="tranx-data">
                    <div class="tranx-label">{{ str($schedule->title)->limit(70) }}</div>
                    <div class="tranx-date mb-1" style="font-size: .90rem;">{{ $schedule->desc ?: 'Tidak memiliki deskripsi' }}</div>
                    <div class="tranx-date">Ruangan {{ str($schedule->room->name)->upper() }} • Oleh pengguna {{ $schedule->user->name }} • {{ $schedule->created_at }}</div>
                    <div class="mt-1">
                      <span class="d-inline-block badge badge-dim badge-primary">{{ $schedule->started_at->isoFormat('LLL') }}</span>
                      <span class="d-inline-block position-relative" style="top:.2rem;">
                        <em class="icon ni ni-caret-right-fill"></em>
                      </span>
                      <span class="d-inline-block badge badge-dim badge-secondary">{{ $schedule->ended_at->isoFormat('LLL') }}</span>
                    </div>
                  </div>
              </div>
          </div>

          @if ($order === 'pending')
          <div class="tranx-col">
            <form method="POST" action="{{ route('admin.submissions.update', $schedule) }}?order=confirm">
              @csrf
              @method('PUT')
              <button onclick="return confirm('Yakin ingin konfirmasi kegiatan ini?')" data-toggle="tooltip" data-placement="left" title="Konfirmasi kegiatan ini?" class="btn btn-sm btn-primary text-white mb-1">
                <em class="icon ni ni-check"></em>
              </button>
            </form>

            <button data-action="{{ route('admin.submissions.update', $schedule) }}?order=reject" data-toggle="tooltip" data-placement="left" title="Hapus kegiatan ini?" class="btn btn-sm btn-outline-danger btn-schedule__rejected">
              <em class="icon ni ni-cross"></em>
            </button>
          </div>
          @endif

        </div>
        <!-- .nk-tranx-item -->
      @endif


    <!-- close tag for last .nk-tranx-item -->
    @if ($key === $schedules->count() - 1 )
    </div>
    @endif


    @php
      $currentItr = $schedule;
    @endphp
  @empty
    <h4 class="text-center mt-3 text-gray">☹️ Data belum tersedia</h4>
  @endforelse

  <!-- hiden visibliy load more button -->
  <!-- <div class="text-center pt-4">
      <a href="#" class="link link-soft"><em class="icon ni ni-redo"></em><span>Muat lebih</span></a>
  </div> -->
</div>



<!-- Modal content for schedule rejected. -->
<div class="modal fade" tabindex="-1" id="modalScheduleRejected">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <form method="POST">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Menolak kegiatan</h5>
                        <p>Berikan alasan terhadap penolakan yang anda berikan.</p>
                    </div>
                </div>
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Alasan penolakan</label>
                        <textarea name="message" class="form-control" placeholder="Contoh: Jadwal mengalami bentrok dsb..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-schedule__rejected-submit" onclick="return confirm('Yakin ingin melakukan ini?')">Tolak kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(main);


    function main() {
        $('button.btn-schedule__rejected').on('click', function () {
            // action endpoint for rejected schedule.
            const uri = $(this).data().action;

            // replace modal form action endpoint.
            $('#modalScheduleRejected').find('form').attr('action', uri);


            $('#modalScheduleRejected').modal();
        });

        $('#modalScheduleRejected').find('form').on('submit', () => {
            $('.btn-schedule__rejected-submit')
                .attr('disabled', 'disabled')
                .text('Tunggu sebentar...');
        });



    }
</script>
@endsection
