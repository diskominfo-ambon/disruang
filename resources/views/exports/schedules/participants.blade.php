<html>

  <table border="1">
    <thead>
      <tr>
        <th height="30" colspan="7" style="vertical-align: middle; text-align: center; font-weight: bold;">{{ $schedule->title }} - Ruangan {{ strtoupper($schedule->room->name) }}</th>
      </tr>
      <tr>
        <th height="30" colspan="7" style="vertical-align: middle; text-align: center;">Dimulai pada {{ $schedule->started_at }} - {{ $schedule->ended_at }}</th>
      </tr>
      <tr height="20" style="vertical-align: middle;">
        <th style="background-color: lightblue;">No</th>
        <th style="background-color: lightblue;">Nama</th>
        <th style="background-color: lightblue;">Nomor telepon</th>
        <th style="background-color: lightblue;">Jenis kelamin</th>
        <th style="background-color: lightblue;">Asal intansi</th>
        <th style="background-color: lightblue;">Status Jabatan</th>
        <th style="background-color: lightblue;">Tanda tangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $schedule->participants as $participant )
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td width="30">{{ $participant->name }}</td>
          <td width="30">{{ $participant->phone_number }}</td>
          <td>{{ $participant->gender }}</td>
          <td>{{ $participant->origin ?? '-' }}</td>
          <td>{{ $participant->origin_job_title ?? '-' }}</td>
          <td>
            @if ($participant->hasSignature)
              <img height="100" width="100" src="{{ public_path('storage/'.$participant->signature) }}"/>
            @else
              -
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</html>
