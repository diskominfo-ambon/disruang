import { ref } from "vue";

import ParticipantRegistration from "~/components/organisms/room-guest-registration-form";
import Heroes from "~/components/atoms/heroes/";

export default {
  setup() {
    const formOverlay = ref(false);

    return {
      formOverlay
    };
  },
  components: {
    Heroes,
    ParticipantRegistration
  },
};
