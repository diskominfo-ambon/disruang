@props(['message'])

<div class="alert text-center alert-sm alert-b alert-b-blue alert-secondary alert-radiusless">
  {{
    empty($message)
      ? $slot
      : $message
  }}
</div>
