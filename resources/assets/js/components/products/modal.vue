<template>
    <div class="modal fade" ref="modalProduct" id="modalProduct" tabindex="-1" role="dialog">
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
                            <form-group-horizontal :label="'Nombre'" name="nombre" :form="form">
                                <input id="name" type="text" class="form-control" ref="firstVisible" v-model="form.data.name" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Descripción'" name="descripcion" :form="form">
                                <textarea class="form-control" v-model="form.data.description" required ></textarea>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Imagen'" name="imagen" :form="form">
                                <input type="file" id="image" ref="image" class="form-control" @change="changeFile" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Precio'" name="precio" :form="form">
                                <input type="text" class="form-control" v-model="form.data.price" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Stock'" name="stock" :form="form">
                                <input type="text" class="form-control" v-model="form.data.stock" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Peso'" name="peso" :form="form">
                                <select class="form-control" v-model="form.data.weight">
                                    <option :value="null" disabled>Selecciona una opción</option>
                                    <option value="00 a 05 kilos">00 a 05 kilos</option>
                                    <option value="05 a 15 kilos">05 a 15 kilos</option>
                                    <option value="15 a 40 kilos">15 a 40 kilos</option>
                                </select>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Largo (cm)'" name="largo" :form="form">
                                <input type="text" class="form-control" v-model="form.data.lenght" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Alto (cm)'" name="alto" :form="form">
                                <input type="text" class="form-control" v-model="form.data.height" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Ancho (cm)'" name="ancho" :form="form">
                                <input type="text" class="form-control" v-model="form.data.width" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Vehiculo'" name="vehiculo" :form="form">
                                <select class="form-control" v-model="form.data.vehicle_id">
                                    <option :value="null" disabled>Selecciona una opción</option>
                                    <option value="1">Motocicleta</option>
                                    <option value="2">Automóvil</option>
                                </select>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Mas vendido'" name="mas_vendido" :form="form">
                                <input type="checkbox" class="" v-model="form.data.is_best_seller"/>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'En promoción'" name="en_promocion" :form="form">
                                <input type="checkbox" class="" v-model="form.data.in_promotion"/>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Es 24 horas'" name="disponible_todo_el_dia" :form="form">
                                <input type="checkbox" class="" v-model="form.data.all_day"/>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Es Top 20'" name="istop20" :form="form">
                                <input type="checkbox" class="" v-model="form.data.istop20"/>
                            </form-group-horizontal>

                            <!-- <form-group-horizontal v-show="title == 'Editar producto'" :label="'Imagen'" name="image" :form="form">
                                <img style="width: 100%" :src="`/${form.data.photo}`">
                            </form-group-horizontal> -->

                            <div class="col-sm-5 col-xs-12" v-show="title == 'Editar producto'">
                                <div class="form-group">
                                    <label>Foto producto</label>
                                    <img style="width: 100%" :src="`${form.data.photo}`">
                                </div>
                            </div>

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
            extensiones : ['.jpg', '.jpeg', '.png', '.gif'],
            formData: new FormData(),
            path: window.Laravel.path,
        }
    }, 
    props: {
        title: { default: 'Nuevo producto'},
        form: { type: Object, required: true }
    },
    mounted() {
        console.log(this.form.data.timeRange)
    },
    methods: { 
        changeFile(e) {
            //console.log(_);
            if (this.$refs.image.files[0] != undefined)
                this.form.data.file = this.$refs.image.files[0];
            let extension = null;
            //let extension = _.split(this.$refs.excel.files[0].name, '.', 2)[1];
            extension = (this.$refs.image.files[0].name.substring(this.$refs.image.files[0].name.lastIndexOf("."))).toLowerCase();
            if($.inArray(extension, this.extensiones) == -1) {
                Notify.overlay('Solo son admitidos archivos con extensión <strong>jpg, jpeg, png y gif</strong>', 'warning');
            }
        },

        close() {
            $('input#image').val('');  
            this.$emit('cancel');
        },

        submit() {
            this.formData.append('vehiculo', this.form.data.vehicle_id);
            this.formData.append('nombre', this.form.data.name);
            this.formData.append('descripcion', this.form.data.description);
            this.formData.append('imagen', this.form.data.file || this.form.data.photo);
            this.formData.append('precio', this.form.data.price);
            this.formData.append('stock', this.form.data.stock);
            this.formData.append('peso', this.form.data.weight);
            this.formData.append('alto', this.form.data.height);
            this.formData.append('largo', this.form.data.lenght);
            this.formData.append('ancho', this.form.data.width);
            this.formData.append('mas_vendido', this.form.data.is_best_seller ? 1 : 0);
            this.formData.append('en_promocion', this.form.data.in_promotion ? 1 : 0);
            this.formData.append('disponible_todo_el_dia', this.form.data.all_day ? 1 : 0);
            this.formData.append('istop20', this.form.data.istop20 ? 1 : 0);

            this.title == 'Crear producto' ? this.store() : this.update();
        },

        store() {
            /*AppHttpForm.post('products', this.form)
                .then(response => {
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`products`, this.formData, {
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
            /*AppHttpForm.patch(`products/${this.form.data.id}`, this.form)
                .then(response => {
                    response.data.index = this.form.data.index;
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`products/${this.form.data.id}`, this.formData, {
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
        changeTimePicker(val) {
            val = _.split(val, ' - ', 2);
            this.form.data.start_selling = val[0];
            this.form.data.end_selling = val[1];
        },
    }
}
</script>
