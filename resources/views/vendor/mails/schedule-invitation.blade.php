<style>
* {
  font-family: arial;
}
</style>

<h3>Undangan kegiatan</h3>

<p>Hai {{ $employee->name }}, kamu diundangan dalam kegiatan
   <b>{{ $schedule->title }}</b> pada pukul {{ $schedule->created_at->locale('id-ID')->isoFormat('LLL') }} sampai {{ $schedule->ended_at->locale('id-ID')->isoFormat('LLL') }}.
 <a href="#">Lihat undangan</a></p>

Terima kasih, salam dan peluk hangat!<br>
{{ config('app.name') }}
