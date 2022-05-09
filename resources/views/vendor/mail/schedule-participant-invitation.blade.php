
@component('mail::layout')
  {{-- Header --}}
  @slot('header')
    @component('mail::header', ['url' => config('app.url')])
    Undangan kegiatan - {{ config('app.name') }}
    @endcomponent
  @endslot

{{-- Body --}}

Hai  <b>{{ $participant->name }}</b>?, kamu diundangan nih dalam kegiatan <b>{{ $schedule->title }}</b> pada  ruangan  {{ $schedule->room->name }} {{ $schedule->started_at->locale('id-ID')->isoFormat('LLL') }} sampai {{ $schedule->ended_at->locale('id-ID')->isoFormat('LLL') }}.

@component('mail::button', ['url' => route('schedule-participant-invitation', [$schedule->slug, $participant->id])])
  Lihat undangan
@endcomponent


  {{-- Footer --}}
  @slot('footer')
    @component('mail::footer')
    © {{ date('Y') }} {{ config('app.name') }}, Terima kasih, salam dan peluk hangat dari disruang dan OPD {{ strtoupper($schedule->user->origin->title) }}
    @endcomponent
  @endslot
@endcomponent
