<html>

  <table>
    <thead>
      <tr>
        <th colspan="7">{{ $schedule->title }}</th>
      </tr>
      <tr>
        <th colspan="7">{{ $schedule->started_at }} - {{ $schedule->ended_at }}</th>
      </tr>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nomor telepon</th>
        <th>Jenis kelamin</th>
        <th>Asal intansi</th>
        <th>Status Jabatan</th>
        <th>Tanda tangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $schedule->participants as $participant )
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td width="30">{{ $participant->name }}</td>
          <td width="30">{{ $participant->phone_number }}</td>
          <td>{{ $participant->gender }}</td>
          <td>{{ $participant->origin }}</td>
          <td>{{ $participant->origin_job_title }}</td>
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
