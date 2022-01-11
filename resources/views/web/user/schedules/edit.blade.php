@extends('web.layouts.dashlite')

@section('content')
<!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title">Ada perubahan yang Anda lakukan?</h2>
</div>
<!-- .buysell-title -->

<!-- .buysell-block -->
<div class="buysell-block" id="app">
  <form class="buysell-form" ref="myformRef" action="{{ route('async.schedules.update', $schedule) }}" data-schedule-id="{{ $schedule->id }}" data-schedule-method="put" method="post" @submit.prevent="onSubmit">
    <div v-if="isMounted">
      {{-- has error message --}}
      <p v-if="form.errors.hasErrorMessage" class="text-white my-2 text-center bg-danger rounded-sm py-1">
        @{{ form.errors.message }}
      </p>

      @csrf
      <p class="fw-bold">1. Tambahkan kegiatan</p>
      <hr/>
      <div class="buysell-field form-group">
        <div class="form-label-group">
          <label for="room" class="form-label">
            Pilih ruangan
          </label>
        </div>
        <div class="dropdown buysell-cc-dropdown">
          <a href="#" data-toggle="dropdown" class="buysell-cc-choosen dropdown-indicator">
            <div class="coin-item coin-btc">
              <div class="coin-icon">
                <em class="icon ni ni-houzz"></em>
              </div>
              <div class="coin-info">
                <span class="coin-name">
                  @{{ roomSelected?.name.toUpperCase() ?? 'Memuat sebentar..' }}
                </span>
                <span class="coin-text">
                  Tersedia jaringan wifi
                </span>
              </div>
            </div>
          </a>

          <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
            <ul class="buysell-cc-list">
              <li class="buysell-cc-item selected" v-for="room in rooms.data" :key="room.id"  @click="form.room_id = room.id">
                <a href="#" class="buysell-cc-opt">
                  <div class="coin-item coin-btc">
                    <div class="coin-icon">
                      <em class="icon ni ni-houzz"></em>
                    </div>
                    <div class="coin-info">
                      <span class="coin-name">
                        @{{ room.name.toUpperCase() }}
                      </span>
                      <span class="coin-text">
                        Tersedia jaringan wifi
                      </span>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <span class="error-text">@{{ form.errors.data?.room_id }}</span>
      </div>

      <div class="buysell-field form-group">
        <div class="form-label-group">
          <label for="title" class="form-label">
            Judul kegiatan
          </label>
        </div>
        <div class="form-control-group">
          <input type="text" v-model="form.title" placeholder="Contoh: kegiatan UMKM..." id="title" name="title" class="form-control form-control-lg form-control-number">
        </div>
        <div class="form-note-group">
          <span class="buysell-min form-note-alt">
            Pastikan gunakan judul yang deskriptif
          </span>
        </div>
        <span class="error-text">@{{ form.errors.data?.title }}</span>
      </div>

      <div class="buysell-field form-group">
        <div class="form-label-group">
          <label for="desc" class="form-label">Deskripsi kegiatan</label>
        </div>
        <div class="form-control-group">
          <textarea maxlength="200" v-model="form.desc" name="desc" id="desc" class="form-control form-control-lg form-control-number"></textarea>
        </div>
        <div class="form-note-group">
            <span class="buysell-min form-note-alt">
              Kamu menambahkan informasi lengkap lainya terkait kegiatan ini seperti kontak, dll..
            </span>
          </div>
        <span class="error-text">@{{ form.errors.data?.desc }}</span>
      </div>
      
      <p class="fw-bold">2. Lengkapi informasi kegiatan</p>
      <hr/>
      <div class="buysell-field form-group">
        <div class="form-label-group">
          <label for="booking-date" class="form-label">
            Booking pada
          </label>
        </div>
        <div class="form-control-group">
          <date-picker
            v-model="form.range"
            mode="dateTime"
            :columns="2"
            :locale="{ id: 'id', firstDayOfWeek: 3, masks: { weekdays: 'WWW', input: ['DD-MM-YY'] } }"
            is-range
            is-expanded
            is24hr
          >
            <template v-slot="{ inputEvents }">
              <div class="date-picker__container"  v-on="inputEvents?.start">
                <div class="date-picker__field">
                  <em class="icon ni ni-calendar-fill"></em>
                  <p :class="form.range.start && 'is-filled'">
                    @{{ scheduleFormatter?.start }}
                  </p>
                </div>
                <div class="date-picker__field">
                  <span>
                    <em class="icon ni ni-swap"></em>
                  </span>
                  <em class="icon ni ni-calendar-check-fill"></em>
                  <p :class="form.range.end && 'is-filled'">
                    @{{ scheduleFormatter?.end }}
                  </p>
                </div>
              </div>

              <span class="error-text">@{{ form.errors.data?.started_at }}</span>
              <span class="error-text">@{{ form.errors.data?.ended_at }}</span>
            </template>
          </date-picker>
        </div>
      </div>
      
      <div class="buysell-field form-group">
        <label for="desc" class="form-label">Kegiatan tersedia untuk umum?</label>
        <div class="d-flex">
          <div class="flex-fill">
            <input class="buysell-pm-control" type="radio" name="general_room" id="pm-asn">
            <label class="buysell-pm-label" for="pm-asn"><span class="pm-name">Hanya untuk ASN</span></label>
          </div>
          <div class="flex-fill">
            <input class="buysell-pm-control" type="radio" name="general_room" id="pm-general">
            <label class="buysell-pm-label" for="pm-general"><span class="pm-name">Boleh untuk umum</span></label>
          </div>
          
        </div>
        <div class="form-note-group">
          <span class="buysell-min form-note-alt">
            Kamu dapat mengatur kegiatan hanya tersedia untuk pegawai ASN, atau untuk pengguanaan umum.
          </span>
        </div>
        <span class="error-text">@{{ form.errors.data?.desc }}</span>
      </div>

      <p class="fw-bold">3. Undang beberapa tamu</p>
      <hr/>
      <div class="buysell-field form-group">
        <div class="form-label-group">
          <label for="title" class="form-label">
            Pilih ASN
          </label>
        </div>
        <div class="form-control-group">
          <input type="text" v-model="form.title" placeholder="Tambahkan beberapa tamu ASN" id="title" name="title" class="form-control form-control-lg form-control-number">
        </div>
        <div class="form-note-group">
          <span class="buysell-min form-note-alt">
            kamu dapat menambahkan beberapa undangan untuk pegawai ASN.
          </span>
        </div>
        <span class="error-text">@{{ form.errors.data?.title }}</span>
      </div>


      <div class="buysell-field form-action">
        <button :disabled="form.isSubmitting" class="btn btn-lg btn-block btn-primary">
        @{{ form.isSubmitting ? 'Sedang mengirim..' : 'Simpan perubahan' }}
        </button>
      </div>
    </div>
    <section v-else v-for="i in 4" :key="i">
      <div class="mt-5">
        <skeletor height="12" width="120"/>
      </div>
      <div class="mt-2">
        <skeletor height="80" width="120%"/>
      </div>
    </section>
  </form>

</div>
<!-- .buysell-block -->
</div>
@endsection


@section('head')
<script defer src="{{ asset('js/vendor/dashlite/schedule.js') }}"></script>
@endsection
