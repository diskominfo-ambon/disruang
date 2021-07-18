<template lang="pug">
form(method="post")
  text-input(labelText="Nama lengkap", v-model="form.fullName")

  .d-flex.align-items-center
    select-input.flex-1.me-2(
      labelText="Jenis kelamin",
      v-model="form.gender",
      :items="GENDER"
    )
    text-input.flex-1(
      type="number",
      labelText="Nomor telepon",
      v-model="form.phoneNumber"
    )

  .d-flex.align-items-start.mt-2
    checkbox-input.me-3(
      labelText="Tanda tangan",
      @change="handleOnAcceptSignature"
    )
    .signature-meta.me-3(
      @click="showSignatureModal = true",
      v-if="signature.isNotEmpty"
    )
      i.fas.fa-signature
      span.signature-label Lihat tanda tangan

    checkbox-input(labelText="Saya ASN?", @change="handleOnAcceptAsn")

  //- form if he asn
  transition(name='form-asn' mode='out-in')
  .form-is-asn(v-if="showAsnForm")
    p Saya ASN
    .d-flex.align-items-center
      text-input.flex-1.me-2(labelText="Nama instansi ASN?", v-model="form.asn.originName")
      text-input.flex-1(labelText="Jabatan ASN?", v-model="form.asn.jobTitle")

  .d-flex.align-items-center.justify-content-end
    button.btn.btn-orange Mulai gabung

  //- signature modal
  transition(name="signature-modal", mode="out-in")
    .signature-modal(v-if="showSignatureModal")
      .signature-modal__header
        button.btn.btn-sm.text-primary(
          type="button",
          @click="handleOnAcceptedSignature"
        )
          i.fas.fa-check-circle
        button.btn.btn-sm.text-secondary(type="button")
          i.fas.fa-backspace

      .signature-modal__content
        .placeholder
          i.fas.fa-signature.fa-2x
          p Mulai tarik disini


</template>
<script>
import { ref, reactive, computed } from 'vue';
import TextInput from '~/components/molecules/text-input';
import SelectInput from '~/components/molecules/select-input';
import CheckboxInput from '~/components/molecules/checkbox-input';

export default {
  setup() {
    const showSignatureModal = ref(false);
    const showAsnForm = ref(false);
    const form = reactive({
      fullName: '',
      gender: '',
      phoneNumber: '',
      asn: {
        originName: '',
        jobTitle: '',
        isNotEmpty: computed(() => {
          const picked = _.pick(form.asn, ['originName', 'jobTitle']);
          return _.valuesIn(picked).every(val => !_.isEmpty(val));
        })
      }
    });

    const signature = reactive({
      data: '',
      isNotEmpty: computed(() => !_.isEmpty(signature.data))
    });

    function handleOnAcceptAsn(e) {
      showAsnForm.value = e.target.checked;
    }

    function handleOnAcceptSignature(e) {
      showSignatureModal.value = e.target.checked;

      if (!e.target.checked) {
        // set signature to empty string.
        signature.data = '';
      }
    }


    function handleOnAcceptedSignature() {
      signature.data = 'ada'; // set signature value to image - base64.
      showSignatureModal.value = false;
    }


    const GENDER = {
      L: 'Laki-laki',
      P: 'Perempuan'
    };

    return {
      handleOnAcceptSignature,
      handleOnAcceptedSignature,
      handleOnAcceptAsn,
      showSignatureModal,
      signature,
      showAsnForm,
      form,
      GENDER
    }
  },
  components: {
    TextInput,
    SelectInput,
    CheckboxInput
  }
}
</script>
<style lang="scss" scoped>

.signature-modal,
.signature-modal-leave-active,
.form-asn,
.form-asn-leave-active {
  transition: all 300ms ease;
}
.signature-modal-enter-from,
.signature-modal-leave-to,
.form-asn-enter-from,
.form-asn-leave-to {
  opacity: 0;
  transform: translateY(200px);
}

.form-is-asn {
  border: 1px solid #ced4da;
  border-radius: 3px;
  position: relative;
  padding: .6rem;
  margin: 1rem 0;
  p {
    margin: 0;
    position: absolute;
    top: -.7rem;
    color: #2283B5 !important;
    border-radius: 2px;
    border: 1px solid #ced4da;
    padding: .1rem .3rem;
    font-size: .9rem;
    background-color: white;
  }

  div {
    margin-top: .5rem;
  }

}
.signature-modal {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: white;
  display: flex;
  flex-direction: column;
  border-radius: 4px;

  &__header {
    background-color: #f6f9ff;
    border-bottom: 1px solid #f1f5ff;
    display: flex;
    align-items: center;
    border-radius: 4px 4px 0 0;
    justify-content: flex-end;
    padding: .3rem .5rem;

    button {
      margin-right: .3rem;

      &:last-child {
        margin-right: 0;
      }
    }
  }
  &__content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;

    .placeholder {
      color: #8a93a7;
      display: flex;
      align-items: center;
      flex-direction: column;
      p {
        color: #8a93a7 !important;
        margin-top: .4rem;
      }
    }
  }
}
.signature-label {
  display: block;
  color: #2283B5;
  font-size: .8rem;
  margin-left: -.2rem;
  cursor: pointer;
}
.signature-meta {
  display: flex;
  border: 1px solid #ced4da;
  padding: .2rem .5rem;
  border-radius: 4px;
  align-items: center;
  position: relative;

  &:hover {
    background-color: #eee;
  }

  svg {
    margin-right: .6rem;
    color: #2283B5 !important;
  }

}
</style>
