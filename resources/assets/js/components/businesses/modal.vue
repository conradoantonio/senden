<template>
    <div class="modal fade" ref="modalBusiness" id="modalBusiness" tabindex="-1" role="dialog">
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
                            <form-group-horizontal  :label="'Nombre comercial'" name="NombreComercial" :form="form">
                                <input type="text" class="form-control" ref="firstVisible" v-model="form.data.tradename" required />
                            </form-group-horizontal>

                            <form-group-horizontal  :label="'Razon social'" name="RazonSocial" :form="form">
                                <input type="text" class="form-control" v-model="form.data.name" required />
                            </form-group-horizontal>

                            <form-group-horizontal class="p" :label="'Categoria'" name="categoria" :form="form">
                                <select class="form-control" v-model="form.data.category_id" required>
                                    <option :value="0"> Escoge una categoria</option>
                                    <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                                </select>
                            </form-group-horizontal>

                            <form-group-horizontal :label="'RFC'" name="rfc" :form="form">
                                <input type="text" class="form-control" v-model="form.data.rfc" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Calle'" name="calle" :form="form">
                                <input type="text" class="form-control" v-model="form.data.street" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Ciudad'" name="ciudad" :form="form">
                                <input type="text" class="form-control" v-model="form.data.city" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Estado'" name="estado" :form="form">
                                <input type="text" class="form-control" v-model="form.data.state" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Colonia'" name="colonia" :form="form">
                                <input type="text" class="form-control" v-model="form.data.colony" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Numero exterior'" name="NumeroExterior" :form="form">
                                <input type="text" class="form-control" v-model="form.data.ext_number" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Numero Interior'" name="NumeroInterior" :form="form">
                                <input type="text" class="form-control" v-model="form.data.int_number"  />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Código Postal'" name="cp" :form="form">
                                <input type="text" class="form-control" v-model="form.data.postal_code" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Telefono'" name="telefono" :form="form">
                                <input type="text" class="form-control" v-model="form.data.phone" required />
                            </form-group-horizontal>

                            <div class="row" id="mapa_detalles">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="" class="form-control" name="buscarMapa" id="buscarMapa" placeholder="Buscar en mapa">
                                        <input name="latitud" id="latitud" type="hidden" v-model="form.data.latitude">
                                        <input name="longitud" id="longitud" type="hidden" v-model="form.data.longitude">
                                        <div id="map" class="z-depth-1 center-align valign-wrapper" style="height: 350px;width: 100%">
                                            <i class="fa fa-spin fa-spinner fa-2x valign-wrapper" style="margin: auto;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form-group-horizontal :label="'Logo'" name="logo" :form="form">
                                <input type="file" id="logo" ref="logo" class="form-control" @change="changeFile(... arguments,'logo')" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Foto 1'" name="foto1" :form="form">
                                <input type="file" id="photo1" ref="photo1" class="form-control" @change="changeFile(... arguments,'foto1')" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Foto 2'" name="foto2" :form="form">
                                <input type="file" id="photo2" ref="photo2" class="form-control" @change="changeFile(... arguments,'foto2')" />
                            </form-group-horizontal>

                            <form-group-horizontal v-show="title == 'Editar Business'" :label="'Logo'" name="logo" :form="form">
                                <img style="width: 100%" :src="`/${form.data.logo}`">
                            </form-group-horizontal>

                            <form-group-horizontal v-show="title == 'Editar Business'" :label="'Foto 1'" name="photo1" :form="form">
                                <img style="width: 100%" :src="`/${form.data.photo1}`">
                            </form-group-horizontal>

                            <form-group-horizontal v-show="title == 'Editar Business'" :label="'Foto 2'" name="photo2" :form="form">
                                <img style="width: 100%" :src="`/${form.data.photo2}`">
                            </form-group-horizontal>


                            <div v-if="form.data.logo && form.data.photo1">
                                <form-group-horizontal v-show="title == 'Editar Negocio'" :label="'Logo'" name="logo" :form="form">
                                    <img style="width: 100%" :src="`/${form.data.logo}`">
                                </form-group-horizontal>

                                <form-group-horizontal v-show="title == 'Editar Negocio'" :label="'Foto 1'" name="photo1" :form="form">
                                    <img style="width: 100%" :src="`/${form.data.photo1}`">
                                </form-group-horizontal>

                                <form-group-horizontal v-if="form.data.photo2" v-show="title == 'Editar Negocio'" :label="'Foto 2'" name="photo2" :form="form">
                                    <img style="width: 100%" :src="`/${form.data.photo2}`">
                                </form-group-horizontal>
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
            extensiones : ['jpg', 'jpeg', 'png', 'gif'],
            formData: new FormData(),
            categories: [],
        }
    }, 
    props: {
        title: { default: 'Nuevo Negocio'},
        form: { type: Object, required: true }
    },

    created() {
        this.fetchCategories();
    },

    mounted() {
        
    },

    methods: { 
        fetchCategories() {
            this.$http.get(`categories`)
                .then(response => {
                    this.categories = response.data.categories;
                })
                .catch(response => {
                    this.form.failProcessing(response.data);
                });
        },
        changeFile(e, tipo) {    

            let file = e.target.files[0];
            if (file != undefined) {
                if (tipo == 'logo') {
                    this.form.data.logoFile = file;
                    
                } else if (tipo == 'foto1') {
                    this.form.data.photo1File = file;
                    
                } else if (tipo == 'foto2') {
                    this.form.data.photo2File = file;
                }

            }
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
            let latitud = $('#latitud').val();
            let longitud = $('#longitud').val();
            this.formData.append('categoria', this.form.data.category_id);
            this.formData.append('NombreComercial', this.form.data.tradename);
            this.formData.append('RazonSocial', this.form.data.name);
            this.formData.append('rfc', this.form.data.rfc);
            this.formData.append('calle', this.form.data.street);
            this.formData.append('NumeroExterior', this.form.data.ext_number);
            this.formData.append('NumeroInterior', this.form.data.int_number || '');
            this.formData.append('cp', this.form.data.postal_code);
            this.formData.append('longitud', longitud);
            this.formData.append('latitud', latitud);
            this.formData.append('colonia', this.form.data.colony);
            this.formData.append('ciudad', this.form.data.city);
            this.formData.append('estado', this.form.data.state);
            this.formData.append('telefono', this.form.data.phone);
            this.formData.append('logo', this.form.data.logoFile || this.form.data.logo);
            this.formData.append('foto1', this.form.data.photo1File || this.form.data.photo1);
            this.formData.append('foto2', this.form.data.photo2File || this.form.data.photo2);

            console.log(this.formData.get('NumeroInterior'));
            this.title == 'Crear Negocio' ? this.store() : this.update();
        },

        store() {
            /*AppHttpForm.post('businesses', this.form)
                .then(response => {
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`businesses`, this.formData, {
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
            /*AppHttpForm.patch(`businesses/${this.form.data.id}`, this.form)
                .then(response => {
                    response.data.index = this.form.data.index;
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`businesses/${this.form.data.id}`, this.formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.form.successProcessing();
                    //window.location.reload();
                })
                .catch(response => {
                    this.form.failProcessing(response.data.errors);
                });



        },
    }
}
</script>
