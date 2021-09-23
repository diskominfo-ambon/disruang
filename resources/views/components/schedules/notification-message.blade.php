@php
$isReject = Schedule::$REJECT === $status;
@endphp

<p class="m-0 {{ $isReject ? 'text-danger' : 'text-success' }}"> {{ $isReject ? '❌' : '✅' }}  {{ $notification->data['title'] ?? '' }}.</p>
@if ($isReject)
<p class="fs-13px pl-2 mt-2" style="border-left: 3px solid red">
    Pesan: {{ $notification->data['message'] ?? '!Tidak menyertakan alasan.' }}
</p>
@endif
