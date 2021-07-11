<template lang="pug">
div
  ul.nav.nav-pills.bg-gray.rounded-2.mb-2.shadow-sm
    li.nav-item
      a.nav-link.active(href="#", aria-disabled="true")
        i.fas.fa-ticket-alt
        span.d-inline-block.ms-2 Pesan ruangan
    li.nav-item
      a.nav-link.disabled(href="#", tabindex="-1", aria-disabled="true")
        i.fas.fa-users
        span.d-inline-block.ms-2 Gabung kegiatan

  .card.shadow.border-none
    .card-body
      div
        form(method="post")
          text-input(labelText="Nama instansi/organisasi")
          room-dropdown-input(labelText="Ruangan yang tersedia")

      div.d-none
        p Form gabung kegiatan

</template>

<script>
import TextInput from '~/components/atoms/text-input';
import AcceptInput from '~/components/atoms/accept-input';
import RoomDropdownInput from '~/components/molecules/room-dropdown-input';


export default {
  components: {
    TextInput,
    AcceptInput,
    RoomDropdownInput
  }
}
</script>

<style lang="scss" scoped>
.nav-item {
  font-size: .9rem !important;
  cursor: pointer;
}
.nav {
  padding: .3rem;
  width: max-content;

  @media (max-width: 767.98px) {
    width: 100%;
  }
}

</style>