@extends('web.layouts.admin')

@section('content')
<!-- .buysell-title -->
<div class="buysell wide-xs m-auto">
  <div class="buysell-title text-center">
    <h2 class="title"><em class="icon ni ni-ticket-plus"></em> Tambahkan kegiatan?</h2>
</div>
<!-- .buysell-title -->

<!-- .buysell-block -->
<div class="buysell-block" id="app">
  <form class="buysell-form" ref="myformRef" action="{{ route('admin.schedules.store') }}" method="post" @submit.prevent="onSubmit">
    {{-- has error message --}}
    <p v-if="form.errors.hasErrorMessage" class="text-white my-2 text-center bg-danger rounded-sm py-1">
      @{{ form.errors.message }}
    </p>

    @csrf
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
        <label for="desc" class="form-label">Deskripsi kegiatan
          <em>
            <span class="buysell-min form-note-alt">
              (Opsional)
            </span>
          </em>
        </label>
      </div>
      <div class="form-control-group">
        <textarea maxlength="200" v-model="form.desc" name="desc" id="desc" class="form-control form-control-lg form-control-number"></textarea>
      </div>

      <span class="error-text">@{{ form.errors.data?.desc }}</span>
    </div>

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

    <div class="buysell-field form-action">
      <button :disabled="form.isSubmitting" class="btn btn-lg btn-block btn-primary">
       @{{ form.isSubmitting ? 'Sedang mengirim..' : 'Tambahkan kegiatan' }}
      </button>
    </div>
  </form>
</div>
<!-- .buysell-block -->
</div>
@endsection


@section('head')
<script defer src="{{ mix('js/vendor/dashlite/schedule.js') }}"></script>
@endsection
