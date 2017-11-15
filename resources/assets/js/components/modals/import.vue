<template>
    <div class="modal fade" ref="importExcel" id="importExcel" tabindex="-1" role="dialog">
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
                            <form-group-horizontal name="Helper" :form="form">
                                <p>
                                    - Para importar registros a través de Excel, los datos deben estar acomodados como se describe a continuación: 
                                    <br>- Los campos de la primera fila de la hoja de excel deben de ir los campos llamados <strong>{{propsExcel}}</strong>
                                    <br>- Finalmente, debajo de cada uno de estos campos deberán de ir los datos correspondientes de los registros.
                                    <br><strong>- Nota: </strong> Solo se aceptan archivos con extensión <kbd>xls y xlsx</kbd> y los registros repetidos en el excel no serán creados.
                                </p>
                            </form-group-horizontal>
                        </form-horizontal>

                        <form-horizontal @submit.prevent="submit">
                            <form-group-horizontal :label="'Excel'" name="excel" :form="form">
                                <input type="file" ref="excel" class="form-control" @change="changeFile" required />
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
            extensiones: ['.xls', '.xlsx'],
            formData: new FormData()
        }
    }, 
    props: {
        title: { default: 'Importar Excel'},
        form: { type: Object, required: true },
        path: { type: String, required: true },
        propsExcel: { type: String, required: true }
    },

    created() {
        
    },
    methods: { 
        changeFile(e) {
            this.form.data.file = null;
            let kilobyte = (this.$refs.excel.files[0].size / 1024);
            let mb = kilobyte / 1024;
            let extension = null;

            //let extension = _.split(this.$refs.excel.files[0].name, '.', 2)[1];
            extension = (this.$refs.excel.files[0].name.substring(this.$refs.excel.files[0].name.lastIndexOf("."))).toLowerCase();
            console.info(extension); 
            if($.inArray(extension, this.extensiones) == -1 || mb >= 5) {
                Notify.overlay('Solo son admitidos archivos con extensión <strong>xls y xlsx</strong>', 'warning');
            } else if(this.$refs.excel.files[0] != undefined || mb <= 5) {
                this.form.data.file = this.$refs.excel.files[0];
            }
        },

        close() {            
            this.$emit('cancel');
        },

        submit() {
            this.store();
            /*if(this.form.data.file instanceof File){
                this.store();
            } else {
                Notify.overlay('Archivo inválido', 'warning');
            }*/
        },

        store() {
            this.formData.append('excel', this.form.data.file || this.form.data.excel);
            this.form.startProcessing();
            this.$http.post(`${this.path}/import/excel`, this.formData, {
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
    }
}
</script>
