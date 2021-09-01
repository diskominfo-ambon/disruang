@extends('web::layouts.app')

@section('title', 'Welcome')

@section('head')
<script src="{{ mix('/js/app.js') }}" defer></script>
<script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
@routes


@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const messageModalToggle = document.getElementById('messageModal');

      // load modal.
    new bootstrap.Modal(messageModalToggle)
      .show();

  });

</script>
@endsection

@section('content')
<x-alert>
  Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama wabah virus <a class="is-link">Corona.</a>
</x-alert>

<x-navbar/>


@inertia

@endsection

