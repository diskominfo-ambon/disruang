@if ($status === Schedule::$PENDING)
    <span>Menunggu tinjauan</span>
@elseif($status === Schedule::$CONFIRM)
    <span class="text-success">Telah diverifikasi</span>
@else
    <span class="text-danger">Ditolak</span>
@endif
