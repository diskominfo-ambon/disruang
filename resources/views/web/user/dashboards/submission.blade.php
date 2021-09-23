@extends('web.layouts.dashlite')


@section('content')


<div class="nk-block-head">
  <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
          <h3 class="nk-block-title fw-normal">Semua permohonan kegiatan Anda</h3>
          <div class="nk-block-des">
              <p></p>
          </div>
      </div>
  </div>
</div>

<!-- .nav-tabs -->
<ul class="nk-nav nav nav-tabs">
  <li class="nav-item">
      <a class="nav-link @if ($order === Schedule::$PENDING) active current-page @endif" href="{{ route('user.submissions') }}?order=pending">Pending</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="{{ route('user.submissions') }}?order=confirm">Diterima</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="{{ route('user.submissions') }}?order=reject">Ditolak</a>
  </li>
</ul>
<!-- end -->
@php
$currentItr = null;
@endphp
<div class="nk-block nk-block-sm">
  @forelse ( $schedules as $key => $schedule )
    @php
    // find all unread notification for this schedule.
    $hasNotification = $schedule->unreadNotifications->count() > 0;
    $status = $schedule->status; // current status of schedule.

    // mark as read notification.
    if ($hasNotification && session()->missing('rejected_on_view')) {
        $schedule->unreadNotifications
            ->first()
            ->markAsRead();
    }

    @endphp

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
                        @if ($hasNotification)
                            <span class="tranx-icon icon ni ni-live text-primary"></span>
                            <span class="badge badge-primary d-block w-full">Baru</span>
                        @else
                            <span class="tranx-icon icon ni ni-live"></span>
                        @endif
                      </div>
                      <div class="tranx-data">
                        <div class="tranx-label">{{ str($schedule->title)->limit(70) }}</div>
                        <div class="tranx-date">{{ str($schedule->room->name)->upper() }} •
                          @include('components.schedules.badge-status', ['status' => $order])
                        </div>


                        <!-- show message schedule rejected notification. -->
                        @if ($schedule->notifications->count() > 0)
                            @php
                                $notification = $schedule->notifications->first();

                            @endphp
                            <div class="mt-2">
                                @include('components.schedules.notification-message', ['payload' => $notification, 'status' => $schedule->status]);
                            </div>
                        @endif

                      </div>
                  </div>
              </div>
              <div class="tranx-col">
                @if (in_array($order, [Schedule::$PENDING, Schedule::$REJECT]))
                <form action="{{ route('user.schedules.destroy', $schedule) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Yakin ingin menghapus ini?')" class="btn btn-sm btn-outline-danger">
                      <em class="icon ni ni-trash-alt mr-1"></em> Hapus
                    </button>
                </form>
                @endif
              </div>
          </div>
        <!-- .nk-tranx-item -->


    @else
      @if ($key > 0)
        </div>
        <!-- close tag the group .nk-tranx-item by date -->
      @endif

      <h6 class="lead-text text-soft">{{ $schedule->created_at }}</h6>
      <div class="tranx-list tranx-list-stretch card card-bordered">
        <!-- .nk-tranx-item -->
        <div class="tranx-item">
          <div class="tranx-col">
              <div class="tranx-info">
                  <div class="tranx-badge">
                    @if ($hasNotification)
                        <span class="tranx-icon icon ni ni-live text-primary"></span>
                        <span class="badge badge-primary d-block w-full">Baru</span>
                    @else
                        <span class="tranx-icon icon ni ni-live"></span>
                    @endif
                  </div>
                  <div class="tranx-data">
                      <div class="tranx-label">{{ str($schedule->title)->limit(70) }}</div>

                      <div class="tranx-date">{{ str($schedule->room->name)->upper() }} •
                        @include('components.schedules.badge-status', ['status' => $order])
                      </div>

                      <!-- show message schedule rejected notification. -->
                      @if ($schedule->notifications->count() > 0)
                        @php
                            $notification = $schedule->notifications->first();

                        @endphp
                        <div class="mt-2">
                            @include('components.schedules.notification-message', ['notification' => $notification, 'status' => $schedule->status])
                        </div>
                      @endif

                  </div>
              </div>
          </div>

          @if (in_array($order, [Schedule::$PENDING, Schedule::$REJECT]))
          <div class="tranx-col">
            @if ($order === Schedule::$PENDING)
              <a href="{{ route('user.schedules.edit', $schedule) }}" class="btn btn-sm btn-secondary text-white mb-1">
                <em class="icon ni ni-edit mr-1"></em> Ubah
              </a>
            @endif

            <form action="{{ route('user.schedules.destroy', $schedule) }}" method="POST">
              @csrf
              @method('DELETE')

              <button onclick="return confirm('Yakin ingin menghapus ini?')" class="btn btn-sm btn-outline-danger">
                <em class="icon ni ni-trash-alt mr-1"></em> Hapus
              </button>
            </form>
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
@endsection
