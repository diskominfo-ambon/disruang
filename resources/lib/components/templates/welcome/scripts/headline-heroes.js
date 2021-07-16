import { ref, computed } from "vue";

import ParticipantRegistrationForm from "~/components/organisms/participant-registration-form";
import RoomGuestRegistrationForm from "~/components/organisms/room-guest-registration-form";
import TextInput from "~/components/atoms/text-input";
import AcceptInput from "~/components/atoms/accept-input";
import RoomDropdownInput from "~/components/molecules/room-dropdown-input";
import Heroes from "~/components/atoms/heroes/";

export default {
  setup() {
    const registerTabComponents = {
      participant: "participant-registration-form",
      roomGuest: "room-guest-registration-form",
    };
    const selectedTab = ref(registerTabComponents.participant);

    const hasTabSelected = computed(() => {
      const { participant, roomGuest } = registerTabComponents;

      return {
        participant: _.isEqual(selectedTab.value, participant),
        roomGuest: _.isEqual(selectedTab.value, roomGuest),
      };
    });

    const handleOnSelectTab = (key) => {
      selectedTab.value = registerTabComponents[key];
    };

    return {
      hasTabSelected,
      selectedTab,
      handleOnSelectTab,
    };
  },
  components: {
    Heroes,
    TextInput,
    AcceptInput,
    RoomDropdownInput,
    ParticipantRegistrationForm,
    RoomGuestRegistrationForm,
  },
};
