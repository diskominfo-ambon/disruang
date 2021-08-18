@extends('web.layouts.admin')


@section('content')

<!-- .nk-block-head-content -->
<div class="row">
  <div class="col-12">
    <div class="nk-block-head-content">
      <h3 class="nk-block-title page-title">Semua Admin</h3>
      <div class="nk-block-des text-soft">
          <p>Terdapat {{ $users->total() }} jumlah admin.</p>
      </div>
    </div>

    {{-- search --}}
    <div class="card card-bordered mt-4">
      <div class="card-body p-1">
        <form>
          <div class="nk-block-between-md">
            <div class="nk-block-between" style="flex:1;">
              <input type="text" name="keyword" value="{{ request()->get('keyword', '') }}" class="form-control" style="font-size: .90rem; border: 0; flex:1;" placeholder="Telusuri nama pengguna, contoh: Azman">
              <button class="btn">
                <em class="icon ni ni-search"></em>
              </button>
            </div>
            <a href="{{ route('admin.d.create') }}" class="btn btn-primary text-white" data-toggle="tooltip" title="Tambah admin baru">
              <em class="icon ni ni-user-add-fill"></em>
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
                      <div class="nk-tb-col"><span class="sub-text">Nama pengguna</span></div>
                      <div class="nk-tb-col tb-col-mb"><span class="sub-text">Waktu mendaftar</span></div>
                      <div class="nk-tb-col tb-col-md"><span class="sub-text">Nomor telepon</span></div>
                      <div class="nk-tb-col tb-col-md"><span class="sub-text">Jumlah kegiatan</span></div>
                      <div class="nk-tb-col tb-col-lg"><span class="sub-text">Akses</span></div>
                      <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
                      <div class="nk-tb-col tb-col-lg"></div>
                      <div class="nk-tb-col tb-col-lg"></div>
                  </div><!-- .nk-tb-item -->
                  @foreach ($users as $user)
                  <div class="nk-tb-item">
                    <div class="nk-tb-col">
                      <a href="html/user-details-regular.html">
                          <div class="user-card">
                              <div class="user-avatar bg-primary">
                                <em class="icon ni ni-user-fill"></em>
                              </div>
                              <div class="user-info">
                                  <span class="tb-lead">{{ $user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                  <span>{{ strtolower($user->email) }}</span>
                              </div>
                          </div>
                      </a>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                      <span>{{ $user->created_at}}</span>
                    </div>
                    <div class="nk-tb-col tb-col-mb">
                      <span class="tb-amount">{{ $user->phone_number }}</span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                      @if ($user->schedules()->count() > 0)
                      <span class="tb-amount">{{ $user->schedules()->count() }} kegiatan yang pernah dibuat</span>
                      @else
                        <span class="tb-amount">Belum pernah membuat kegiatan</span>
                      @endif
                    </div>
                    <div class="nk-tb-col tb-col-md">
                      <span class="tb-status text-primary">{{ strtoupper($user->permissions()->first() ?: 'kominfo') }}</span>
                    </div>
                      <div class="nk-tb-col tb-col-md">
                          <span class="tb-status text-success">Aktif</span>
                      </div>
                      <div class="nk-tb-col nk-tb-col-tools">
                        <a href="{{ route('admin.d.edit', $user) }}" class="btn btn-icon btn-trigger" data-toggle="tooltip" title="Ubah pengguna"><em class="icon ni ni-edit-fill"></em></a>
                      </div>
                      <div class="nk-tb-col nk-tb-col-tools">
                        @cannot(['humas', 'protocol'])
                        <form action="{{ route('admin.d.destroy', $user) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button onclick="return confirm('Yakin ingin menghapus ini?')" class="btn btn-icon btn-trigger" data-toggle="tooltip" title="Hapus pengguna"><em class="icon ni ni-trash-fill text-danger"></em></button>
                        </form>
                        @endcannot
                      </div>
                  </div><!-- .nk-tb-item -->
                  @endforeach
              </div><!-- .nk-tb-list -->
          </div><!-- .card-inner -->

          <!-- .card-inner-group -->
          @if ($users->total() > 20)
          <div class="card-inner">
            <div class="g">
              {{ $users->links('pagination::bootstrap-4') }}
              <!-- .pagination -->
          </div>
          @endif
      </div>
    </div>
  </div>
  </div>
</div>
@endsection
