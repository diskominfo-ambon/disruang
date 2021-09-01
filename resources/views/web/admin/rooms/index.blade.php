@extends('web.layouts.admin')


@section('content')

<!-- .nk-block-head-content -->
<div class="row">
  <div class="col-12">
    <div class="nk-block-head-content">
      <h3 class="nk-block-title page-title">Semua ruangan</h3>
      <div class="nk-block-des text-soft">
          <p>Terdapat {{ $rooms->total() }} jumlah ruangan.</p>
      </div>
    </div>

    {{-- search --}}
    <div class="card card-bordered mt-4">
      <div class="card-body p-1">
        <form>
          <div class="nk-block-between-md">
            <div class="nk-block-between" style="flex:1;">
              <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" style="font-size: .90rem; border: 0; flex:1;" placeholder="Telusuri nama ruangan..">
              <button class="btn">
                <em class="icon ni ni-search"></em>
              </button>
            </div>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary text-white" data-toggle="tooltip" title="Tambah admin baru">
              <em class="icon ni ni-plus"></em>
            </a>
          </div>
        </form>
      </div>
    </div>
    {{-- end --}}

    <div class="card card-bordered card-stretch mt-3">
      <div class="card-inner-group">
          <div class="card-inner p-0">
              <div class="nk-tb-list nk-tb-ulist">
                  <div class="nk-tb-item nk-tb-head">
                      <div class="nk-tb-col"><span class="sub-text">Nama ruangan</span></div>
                      <div class="nk-tb-col tb-col-mb"><span class="sub-text">Dibuat pada</span></div>
                      <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
                      <div class="nk-tb-col tb-col-lg"></div>
                  </div><!-- .nk-tb-item -->
                  @foreach ($rooms as $room)
                  <div class="nk-tb-item">
                    <div class="nk-tb-col tb-col-mb">
                      <span class="tb-amount">Ruangan {{ strtoupper($room->name) }}</span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                      <span>{{ $room->created_at}}</span>
                    </div>
                      <div class="nk-tb-col tb-col-md">
                          <span class="tb-status text-success">Aktif</span>
                      </div>
                      <div class="nk-tb-col nk-tb-col-tools">
                        <div class="nk-block-between">
                          <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-icon btn-trigger" data-toggle="tooltip" title="Ubah ruangan"><em class="icon ni ni-edit-fill"></em></a>
                          <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus ini?')" class="btn btn-icon btn-trigger" data-toggle="tooltip" title="Hapus ruangan"><em class="icon ni ni-trash-fill text-danger"></em></button>
                          </form>
                        </div>
                      </div>

                  </div><!-- .nk-tb-item -->
                  @endforeach
              </div><!-- .nk-tb-list -->
          </div><!-- .card-inner -->

          <!-- .card-inner-group -->
          @if ($rooms->total() > 20)
          <div class="card-inner">
            <div class="g">
              {{ $rooms->links('pagination::bootstrap-4') }}
              <!-- .pagination -->
          </div>
          @endif
      </div>
    </div>
  </div>
  </div>
</div>
@endsection
