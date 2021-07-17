<template lang="pug">
form(method="post")
  text-input(labelText="Nama instansi")
  dropdown-input(
    labelText="Ruangan yang tersedia",
    placeholderText="Pilih ruangan"
    )
    .dropdown-suggestion
      .dropdown-suggestion__content
        i.fas.fa-door-open
        p Ruangan Darwin
      .dropdown-suggestion__meta-wrapper
        .dropdown-suggestion__meta
          i.fas.fa-wifi
          p Tersedia akses internet
        .dropdown-suggestion__meta
          i.fas.fa-person-booth
          p Memiliki 30 kapasitas

  .d-flex.align-items-center
    .d-flex.align-items-center.justify-content-between.w-100
      datetime-picker-input(labelText="Tanggal pemesanan")
      checkbox-input.align-self-end.ms-3.mb-3(labelText="Saya ASN?")
  .d-flex.align-items-center.justify-content-end.mt-1
    button.btn.btn-orange Mulai booking
</template>
<script src="./scripts/participant-registration-form.js"></script>
<style lang="scss" scoped>
.dropdown-suggestion {
  padding: 0.575rem 0.75rem;
  cursor: pointer;
  border-bottom: 1px solid #ced4da;
  p {
    margin: 0;
  }

  &:last-child {
    border: none;
  }
  &:hover {
    background-color: #eee;
  }

  &__content {
    display: flex;
    align-items: center;
    svg {
      margin-right: .5rem;
      color: #2283B5 !important;
    }
  }
  &__meta {
    display: flex;
    align-items: center;
    margin-right: .6rem;

    &:last-child {
      margin-right: 0;
    }

    p {
      font-size: .8rem;
      color: #8a93a7 !important;
    }

    svg {
      width: 13px;
      margin-right: .3rem;
      color: #2283B5 !important;
    }
  }
  &__meta-wrapper {
    margin-top: .5rem;
    display: flex;
    align-items: center;
  }
}
</style>

