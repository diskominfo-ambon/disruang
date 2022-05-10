
@component('mail::layout')
  {{-- Header --}}
  @slot('header')
    @component('mail::header', ['url' => config('app.url')])
    Undangan kegiatan - {{ config('app.name') }}
    @endcomponent
  @endslot

{{-- Body --}}

Hai  <b>{{ $employee->name }}</b>?, kamu diundangan nih dalam kegiatan <b>{{ $schedule->title }}</b> pada  ruangan  {{ $schedule->room->name }} {{ $schedule->started_at->locale('id-ID')->isoFormat('LLL') }} sampai {{ $schedule->ended_at->locale('id-ID')->isoFormat('LLL') }}.

@component('mail::button', ['url' => route('schedule-invitation', [$schedule->slug, $employee->id])])
  Lihat undangan
@endcomponent


  {{-- Footer --}}
  @slot('footer')
    @component('mail::footer')
    © {{ date('Y') }} {{ config('app.name') }}, Terima kasih, salam dan peluk hangat dari disruang dan OPD
    @if (is_null($schedule->user->origin?->title))
    {{ strtoupper($schedule->user->name) }}
    @else
    {{ strtoupper($schedule->user->origin->title) }}
    @endif
    @endcomponent
  @endslot
@endcomponent
