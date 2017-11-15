<style>
    .pac-container {
        z-index: 1051 !important;
    }
</style>
<template>
    <div class="modal fade" ref="modalFaq" id="modalFaq" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        {{ title }}
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <form-horizontal @submit.prevent="submit">
                            <form-group-horizontal :label="'Pregunta'" name="pregunta" :form="form">
                                <input type="text" class="form-control" ref="firstVisible" v-model="form.data.question" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Respuesta'" name="respuesta" :form="form">
                                <input type="text" class="form-control" v-model="form.data.answer" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Imagen'" name="imagen" :form="form">
                                <input type="file" id="image" ref="image" class="form-control" @change="changeFile" required />
                            </form-group-horizontal>

                            <form-group-horizontal v-show="title == 'Editar Faq'" :label="'Imagen'" name="image" :form="form">
                                <img style="width: 100%" :src="`/${form.data.image}`">
                            </form-group-horizontal>

                        </form-horizontal>
                    </div>
                    
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <form-submit :form="form" @click="submit"></form-submit>
                    <button type="button" @click="close" class="btn btn-default" data-dismiss="modal"> Cerrar </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import AppForm from './../../common/AppForm';
import AppHttpForm from './../../common/AppHttpForm';
import Notify from './../../common/Notify';
import Bus from './../../bus';

export default {

    data() {
        return {
            extensiones : ['jpg', 'jpeg', 'png', 'gif'],
            formData: new FormData()
        }
    }, 
    props: {
        title: { default: 'Nuevo Faq'},
        form: { type: Object, required: true }
    },

    created() {
        
    },
    methods: { 
        changeFile(e) {    
            if (this.$refs.image.files[0] != undefined)
                this.form.data.file = this.$refs.image.files[0];
            let extension = _.split(this.$refs.image.files[0].name, '.', 2)[1];
            if($.inArray(extension, this.extensiones) == -1) {
                console.log(Notify);
                Notify.overlay('Solo son admitidos archivos con extensión <strong>jpg, jpeg, png y gif</strong>', 'warning');
            }
        },

        close() {
            $('input#image').val('');  
            this.$emit('cancel');
        },

        submit() {
            this.formData.append('pregunta', this.form.data.question);
            this.formData.append('respuesta', this.form.data.answer);
            this.formData.append('imagen', this.form.data.file || this.form.data.image);
            this.title == 'Crear Faq' ? this.store() : this.update();
        },

        store() {
            /*AppHttpForm.post('faqs', this.form)
                .then(response => {
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`faqs`, this.formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.form.successProcessing();
                    window.location.reload();
                })
                .catch(response => {
                    this.form.failProcessing(response.data);
                });




        },

        update() {
            /*AppHttpForm.patch(`faqs/${this.form.data.id}`, this.form)
                .then(response => {
                    response.data.index = this.form.data.index;
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`faqs/${this.form.data.id}`, this.formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.form.successProcessing();
                    window.location.reload();
                })
                .catch(response => {
                    this.form.failProcessing(response.data.errors);
                });



        },
    }
}
</script>
