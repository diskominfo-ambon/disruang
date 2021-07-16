<template lang="pug">
form(method="post")
  text-input(labelText="Nama instansi")
  dropdown-input(labelText="Ruangan yang tersedia")
  .d-flex.align-items-center.justify-content-between
    .d-flex.align-items-center
      p form date picker
      accept-input(labelText="ASN?")
    div
      button.btn.btn-orange Mulai booking
</template>
<script src="./scripts/participant-registration-form.js"></script>
