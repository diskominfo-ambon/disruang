@extends('web.layouts.app')


@section('head')
<style>

    .lottie {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        flex-direction: column;
    }

    .lottie p {
        color: gray !important;
        text-align: center;

    }
</style>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

@endsection

@section('content')

<div class="container">
    <div class="lottie">
        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_smcd09k7.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
        <h2>Terima kasih, absensi Anda berhasil</h2>
        <p>
            Terima kasih Anda telah melakukan absensi pada kegiatan
            <br>
            <u>{{ $schedule->title }}</u> pada ruangan {{ strtoupper($schedule->room?->name) }} oleh {{ $schedule->user->origin ? strtoupper($schedule->origin->title) : $schedule->user->name  }}

        </p>
    </div>
</div>
@endsection
