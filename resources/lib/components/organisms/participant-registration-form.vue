<template lang="pug">
form(method="post")
  text-input(labelText="Nama instansi")
  room-dropdown-input(labelText="Ruangan yang tersedia")
  .d-flex.align-items-center.justify-content-between
    .d-flex.align-items-center
      p form date picker
      accept-input(labelText="ASN?")
    div
      button.btn.btn-orange Mulai booking
</template>
<script>
import TextInput from "~/components/atoms/text-input";
import AcceptInput from "~/components/atoms/accept-input";
import RoomDropdownInput from "~/components/molecules/room-dropdown-input";

export default {
  components: {
    TextInput,
    AcceptInput,
    RoomDropdownInput,
  },
};
</script>

