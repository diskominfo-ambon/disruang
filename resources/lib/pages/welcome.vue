<template lang="pug">
div
  alert.text-center.alert-radiusless.alert-sm.alert-b.alert-b-blue(variant="secondary") Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama wabah virus&nbsp;
    a.is-link(href="") Corona.
  navbar
  headline-heroes
</template>

<script>
import Alert from "~/components/atoms/alert";
import Navbar from "~/components/molecules/navbar";
import HeadlineHeroes from "~/components/templates/welcome/headline-heroes";

export default {
  components: {
    Alert,
    Navbar,
    HeadlineHeroes,
  },
};
</script>
