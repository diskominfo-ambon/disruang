<template lang="pug">
form(method="post")
  text-input(labelText="Nama lengkap")
  .d-flex.align-items-center
    text-input.flex-1.me-2(labelText="Jenis kelamin")
    text-input.flex-1(labelText="Nomor telepon")
  .d-flex.align-items-start.mt-2
    div
      checkbox-input.me-4(labelText="Tanda tangan")
      .signature-meta
        i.fas.fa-signature
        span.signature-label Lihat tanda tangan
    checkbox-input(labelText="Saya ASN?")
  .d-flex.align-items-center.justify-content-end
    button.btn.btn-orange Mulai gabung


</template>
<script>
import TextInput from '~/components/molecules/text-input';
import CheckboxInput from '~/components/molecules/checkbox-input';

export default {
  components: {
    TextInput,
    CheckboxInput
  }
}
</script>
<style lang="scss" scoped>
.signature-label {
  display: block;
  text-decoration: underline;
  color: #2283B5 !important;
  font-size: .8rem;
  cursor: pointer;
}
.signature-meta {
  display: flex;
  align-items: center;
  position: relative;
  top: -.5rem;
  svg {
    margin-right: .6rem;
    color: #2283B5 !important;
  }

}
</style>
