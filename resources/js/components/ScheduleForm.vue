<template>
    <div>
        <Devider labelText="1. Tambahkan kegiatan"/>
        <FormGroup 
            labelText="Pilih ruangan"
            >
            <VSelect/>
        </FormGroup>

        <FormGroup 
            labelText="Judul kegiatan"
            alertText="Pastikan gunakan judul yang deskriptif"
            >
            <Input isLarge/>
        </FormGroup>

        <FormGroup 
            labelText="Deskripsi kegiatan"
            alertText="Kamu menambahkan informasi lengkap lainya terkait kegiatan ini seperti kontak, dll."
            >
            <Textarea />
        </FormGroup>
        <FormGroup
            labelText="Unggah materi"
            alertText="(Opsional) unggah beberapa materi untuk membantu pengujung."
        >
            <FilePond
                labelIdle="Tarik atau klik untuk menggungah."
                :allowMultiple="true"
                acceptedFileTypes="application/pdf"
            />
        </FormGroup>

        <Divider labelText="2. Lengkapi informasi kegiatan"/>

        <DateRangeInput/>
        <Divider labelText="3. Undang beberap tamu"/>
        <FormGroup labelText="Pilih ASN">
            <VSelect/>
        </FormGroup>
    </div>
</template>

<script>
import { computed, reactive, onErrorCaptured, defineComponent, onMounted, ref } from 'vue';
import { Skeletor } from 'vue-skeletor';
import { assign, merge, pick, omit, mapValues } from 'lodash';
import VSelect from 'vue-select';
import buildFilePond from "vue-filepond";

import 'vue-select/dist/vue-select.css';
import "filepond/dist/filepond.min.css";


import useFetch from '~/utils/use-fetch';
import Input from '~/components/Input';
import Textarea from '~/components/Textarea';
import DateRangeInput from '~/components/DateRangeInput';
import FormGroup from '~/components/FormGroup';
import Divider from '~/components/Divider';

const ENDPOINT_ROOMS = '';

const FilePond = buildFilePond();

export default defineComponent({
    props: ['initialData'],
    components: {
        VSelect,
        FormGroup,
        Input,
        Textarea,
        FilePond,
        DateRangeInput,
        Skeletor,
        Divider,
    },
    setup() {
      const $form = reactive({
          roomId: null,
          title: '',
          description: '',
          date: {
              start: new Date(),
              end: null
          },
          employees: [],
          isPublicAvailable: true,
          attachments: []
      });
      
      

      onMounted(() => {
            useFetch(ENDPOINT_ROOMS)
                .then(data => {
                    rooms.current = data
                });

                if (Object.keys($props.$initialData).length > 0) {
                    $form = { ...$props.$initialData};
                }


      });


      function handleOnSubmitted() {
          $props.onSubmitted();
      }


        return {
            handleOnSubmitted
        }
    },
})
</script>

<style lang="css" scoped>

</style>