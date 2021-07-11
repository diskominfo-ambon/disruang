<template lang="pug">
div
  alert.text-center.alert-radiusless.alert-sm.alert-b.alert-b-blue Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama wabah virus&nbsp;
    a.is-link(href="") Corona.
  navbar
  jumbotron-form

</template>

<script>
import Alert from "~/components/atoms/alert";
import Navbar from '~/components/molecules/navbar';
import JumbotronForm from '~/components/organisms/jumbotron-form';

export default {
  components: {
    Alert,
    Navbar,
    JumbotronForm,
  },
};
</script>
