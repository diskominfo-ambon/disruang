@extends('web.layouts.app')



@section('head')
<style>
.alert {
  border-radius: 0;
  text-align: center;
}
.jumbroton {
  flex-direction: column;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 5rem 0;
}
.box img {
    width: 60px;
    height: 60px;
    margin-bottom: .8rem;
    filter: saturate(.3);
}
.jumbroton .box {
  width: 700px;
  text-align: center;
}
.jumbroton h2 {
  text-align: center;
  font-size: 2rem;
}
.jumbroton h2 span {
    color: #1BA0E2;
    font-weight: bold;
}

.jumbroton .form__wrapper section {
  border: 1px solid #E2E2E2;
  width: 750px;
  border-radius: 3px;
  position: relative;
  top: 1.6rem;
  overflow: hidden;
  padding: 1rem;
  margin-bottom: 1rem;
  max-height: 50px;
}
fieldset legend {
  font-size: .8rem;
  color: gray;
  margin-bottom: 1rem;
}

fieldset .form-group {
  flex: 1;
  margin-right: 1rem;
}
fieldset .form-group:last-child {
  margin-right: 0 !important;
}

fieldset .form-group .form-control {
  background-color: #F6F6F6;
}

fieldset .form-group label {
  font-size: .91rem;
  margin-bottom: .4rem;
  color: #454545;
  font-weight: 200;
}
fieldset .btn.btn-secondary {
  color: white !important;
  position: relative;
  bottom: .7rem;
}
fieldset .form-control__dropdown .title {
  font-size: .91rem;
  margin-bottom: .2rem;
}
fieldset .form-control__dropdown span {
  font-size: .8rem;
  color: #454545;
  margin: 0;
}
.dropdown .btn span svg {
    width: 20px;
    height: 20px;
    color: gray;
    margin-right: .3rem;
    position: relative;
    top: -.1rem;
}
.dropdown button {
    display: flex;
    align-items: center;
    justify-content: center;
}
fieldset .dropdown {
    margin-right: .7rem;
}
fieldset .filter {
    display: flex;
}
fieldset .filter p {
  font-size: .9rem;
  margin: 0;
  margin-right: .8rem;
  position: relative;
  top: .3rem;
}
@keyframes show {
    0% {
        max-height: 50px;
        opacity: 0;
    }

    50% {
        opacity: 0;
        max-height: 100px;
    }

    100% {
        opacity: 1;
        max-height: 1000px;
    }
}
.jumbroton .form__wrapper section.active {
    border-color: #1BA0E2;
    border-width: 1.5px;
    animation: show 500ms cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards;
}

.actions span {
    display: block;
    font-size: .8rem;
    width: 400px;
    color: #454545;
}
.actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 2.5rem !important;
}

.actions .btn {
    padding: .5rem 1rem;
}
.actions .btn.btn-primary {
    color: white !important;
    background-color: #1BA0E2;
    margin-left: .5rem;
}

.d-hide {
  display: none;
}

.content {
  padding: 0;
  margin: 0;
  margin-top: 1rem;
  list-style: none;
}

.content li:hover {
  background-color: #F6F6F6;
}
.content li {
  border-bottom: 1px solid #E2E2E2;
  display: flex;
  padding: .9rem;
  align-items: center;
  margin: 0;
  cursor: pointer;
}
.content li:last-child {
  border: none;
}
.content li .content__circle {
  height: 40px;
  width: 40px;
  background-color: #C4C4C4;
  border-radius: 50%;
  margin-right: 1rem;
}
.content .content-desc__header {
  display: flex;
  margin-bottom: .5rem;
  font-size: .8rem;
}
.content .content-desc__header div:first-child {
  margin-right: .8rem;
}
.content .content-desc__header div span {
  border: 1px solid #E2E2E2;
  padding: .3rem .7rem;
  border-radius: 7px;
  margin-left: .5rem;
}
.content .content-desc__header div::before {
  content: '';
  height: 10px;
  width: 10px;
  display: inline-block;
  border-radius: 50%;
  margin-right: .4rem;
}
.content .content-desc__header div:first-child::before {
  background-color: #24D07E;
}
.content .content-desc__header div:last-child::before {
  background-color: #3E3E3E;
}
.content .content-desc__body p {
  margin: 0;
  font-weight: 700;
}
.content .content-desc__body span {
  font-size: .8rem;
}
.content__placeholder img {
  width: 150px;
}
.content__placeholder {
  text-align: center;
}
.content__placeholder p {
  position: relative;
  top: -30px;
}
</style>
@endsection

@section('content')
<header>
  <div class="alert alert-secondary alert-b-blue alert-b">
    <div class="container">
      Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama Wabah Virus Corona, <a href="#">disini</a>.
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand text-dark" href="#">disruang</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
        <div class="d-flex">
          <a href="{{ route('auth.login') }}" class="btn btn-outline-primary">Masuk</a>
        </div>
      </div>
    </div>
  </nav>
</header>


<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="jumbroton">
        <div class="box">
            <img src="{{ asset('images/logo-pemkot.png') }}" alt="logo-pemkot">
            <h2>Pemesanan ruangan jauh lebih menyenangkan bersama <span>disruang</span></h1>
        </div>

        <div class="form__wrapper">
          <form>
            <section class="active">
                <fieldset>
                    <legend>1. Data informasi kegiatan</legend>
                    <div class="filter">
                        <p>Urutkan</p>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                              </span>
                              <span class="text">Ruangan DARWIN</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li data-key="room" data-value="1"><a class="dropdown-item" data-value="1" href="#">Ruangan DARWIN</a></li>
                              <li data-key="room" data-value="2"><a class="dropdown-item" data-value="2" href="#">Ruangan VLISINGEN</a></li>
                            </ul>
                        </div>
                        {{-- <div class="dropdown">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                              </span>
                              <span class="text">Hari ini</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li data-key="started" data-value="1"><a class="dropdown-item" href="#">Hari ini</a></li>
                              <li data-key="started" data-value="2"><a class="dropdown-item" href="#">Akan datang</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="content__container">
                      <div class="content__placeholder d-hide">
                        <img src="{{ asset('images/loading.gif') }}" alt="">
                        <p>Tunggu sebentar...</p>
                      </div>
                      <ul class="content"></ul>
                    </div>
                </fieldset>
            </section>
            <section>
                <fieldset>
                  <legend>2. Data pengguna</legend>
                  <div>
                      <div class="form-group">
                          <label for="">Nama lengkap</label>
                          <input type="text" class="form-control" name="name" required>
                      </div>
                      <div class="form-group">
                        <label for="">Nomor telepon</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="text" class="form-control" required aria-label="phone" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nama tokoh (Opsional)</label>
                        <input type="text" class="form-control" required name="origin" placeholder="Contoh: Ketua pemuda UMKM Maluku">
                    </div>
                  </div>
                </fieldset>
            </section>
            <div class="actions">
                <span>
                    Dengan mengklik daftar berarti Anda sudah menyetuji segala bentuk <strong>kebijakan & ketentuan</strong> yang berlaku.
                </span>
                <div>
                    <button class="btn btn-secondary text-white d-hide btn-previous">Kembali</button>
                    <button class="btn btn-primary btn-submitted">Lanjutkan</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', main);

    function main() {
        let currentSection = 1;
        const date = new Date();
        const currentDate = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;

        let filter = {
          room: 1,
          date: currentDate
        };



        const sections = document.querySelectorAll('section');
        const btnSubmitted = document.querySelector('.btn-submitted');
        const btnPrevious = document.querySelector('.btn-previous');
        const dropdowns = document.querySelectorAll('.dropdown');
        const content = document.querySelector('.content');
        const contentPlaceholder = document.querySelector('.content__placeholder');

        dropdowns.forEach(dropdown => {

          const dropdownBtn = dropdown.querySelector('button.btn');
          const dropdownMenu = dropdown.querySelector('ul.dropdown-menu');

          dropdownBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
          });

          const dropdownItems = dropdownMenu.querySelectorAll('li');
          dropdownItems.forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
              const dropdownText = dropdownItem.textContent;
              dropdownMenu.classList.remove('show');
              dropdownBtn.querySelector('.text').textContent = dropdownText;

              const key = dropdownItem.dataset.key;
              const value = dropdownItem.dataset.value;


              onFetch({
                [key]: value,
                date: currentDate,
              });
            });
          });
        });

        onFetch(filter);

        async function onFetch(data) {
          contentPlaceholder.classList.remove('d-hide');
          content.classList.add('d-hide');
          try {
              const endpoint = window.origin + '/api/schedules?roomid=' + data.room + '&mindate='+data.date;
              const res = await fetch(endpoint);
              const result = await res.json();

              render(result.payload);

              contentPlaceholder.classList.add('d-hide');
              content.classList.remove('d-hide');
          } catch (e){
            alert('Terjadi kesalahan saat memuat data');
            window.reload();
          }

        }

        function h(name) {
            return document.createElement(name);
        }

        function render(items) {
            content.innerHTML = '';

            items.forEach(item => {
                const started = new Date(item.started_at);
                const ended = new Date(item.ended_at);
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    timeZone: 'Asia/Jayapura',
                    dayPeriod: "short",
                    hour: 'numeric',
                    minute: 'numeric',
                    timeZoneName: 'short'
                };

                const listItem = `
                    <li>
                        <div class="content__circle"></div>
                        <div classs="content__desc">
                            <div class="content-desc__header">
                                <div>Mulai <span>${new Intl.DateTimeFormat('id-ID', options).format(started)}</span></div>
                                <div>Berakhir <span>${new Intl.DateTimeFormat('id-ID', options).format(ended)}</span></div>
                            </div>
                            <div class="content-desc__body">
                                <p>Ruangan ${item.room.name.toUpperCase()} - ${item.title}</p>
                                <span class="d-block">${item.desc}</span>
                                <span>Diterbitkan oleh ${item.user.name}</span>
                            </div>
                        </div>
                    </li>
                `;

                const doc = new DOMParser().parseFromString(listItem, "text/html");
                content.appendChild(doc.documentElement);
            });
        }

        btnSubmitted.addEventListener('click', onSubmitted);

        btnPrevious.addEventListener('click', onPrevious)


        function setSectionActivated(index) {
            sections.forEach((section, i) => {
                if (i === index) {
                    section.classList.add('active');

                }else {

                    section.classList.remove('active');
                }

            });
        }

        function onPrevious(e) {
            e.preventDefault();

            this.classList.add('d-hide');
            btnSubmitted.textContent = 'Lanjutkan';
            currentSection--;

            setSectionActivated( currentSection - 1);
        }

        function onSubmitted(e) {
            e.preventDefault();

            if (currentSection >= sections.length) {
              alert('submit');
              return;
            }

            currentSection++;
            this.textContent = 'Daftar kegiatan';
            btnPrevious.classList.remove('d-hide');
            setSectionActivated( currentSection - 1);
        }

    }
</script>
@endsection
