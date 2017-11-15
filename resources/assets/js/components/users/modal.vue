<template>
    <div class="modal fade" ref="modalUser" id="modalUser" tabindex="-1" role="dialog">
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
                            <form-group-horizontal v-show="!business_id" :label="'Negocio'" name="negocio" :form="form">
                                <select v-model="form.data.business_id" :disabled="title == 'Editar Usuario'" required>
                                    <option :value="0"> Escoge un negocio</option>
                                    <option :value="business.id" v-for="business in businesses">{{business.name}}</option>
                                </select>
                            </form-group-horizontal>
                            <form-group-horizontal :label="'Nombre'" name="nombre" :form="form">
                                <input type="text" class="form-control" ref="firstVisible" v-model="form.data.name" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :label="'Email'" name="email" :form="form">
                                <input type="text" class="form-control" v-model="form.data.email" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :label="'Password'" name="password" :form="form">
                                <input type="text" class="form-control" v-model="form.data.password" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :label="'Calle'" name="calle" :form="form">
                                <input type="text" class="form-control" v-model="form.data.street" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :wsize="4" :label="'Numero Exterior'" name="numero_exterior" :form="form">
                                <input type="text" class="form-control" v-model="form.data.ext_number" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :wsize="4" :label="'Numero Interior'" name="numero_interior" :form="form">
                                <input type="text" class="form-control" v-model="form.data.int_number"  />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :wsize="4" :label="'Colonia'" name="colonia" :form="form">
                                <input type="text" class="form-control" v-model="form.data.colony" required />
                            </form-group-horizontal>

                            <form-group-horizontal :wsize="4" :label="'Municipio'" name="municipio" :form="form">
                                <input type="text" class="form-control" v-model="form.data.municipality" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :wsize="4" :label="'Estado'" name="estado" :form="form">
                                <input type="text" class="form-control" v-model="form.data.state" required />
                            </form-group-horizontal>
                            
                            <form-group-horizontal :wsize="4" :label="'Codigo Postal'" name="codigo_postal" :form="form">
                                <input type="text" class="form-control" v-model="form.data.postal_code" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Imagen'" name="imagen" :form="form">
                                <input type="file" id="image" ref="image" class="form-control" @change="changeFile(... arguments,'foto')" required />
                            </form-group-horizontal>

                            <form-group-horizontal :label="'Tipo'" name="imagen" :form="form">
                                <select v-model="form.data.user_type_id" :disabled="title == 'Editar Usuario'" required>
                                    <option :value="0"> Escoge un tipo</option>
                                    <option :value="type.id" v-for="type in types">{{type.name}}</option>
                                </select>
                            </form-group-horizontal>

                            <div v-show="isSendenBoy">

                                <form-group-horizontal :label="'Banco'" name="banco" :form="form">
                                    <input type="text" class="form-control" v-model="form.data.bank" required />
                                </form-group-horizontal>


                                <form-group-horizontal :label="'Clabe'" name="clabe" :form="form">
                                    <input type="text" class="form-control" v-model="form.data.clabe" required />
                                </form-group-horizontal>

                                <form-group-horizontal :label="'Placas'" name="placas" :form="form">
                                    <input type="text" class="form-control" v-model="form.data.plate_number" required />
                                </form-group-horizontal>

                                <form-group-horizontal :label="'Vehiculo'" name="imagen" :form="form">
                                    <select v-model="form.data.vehicle_id" required>
                                        <option :value="0"> Escoge un vehiculo</option>
                                        <option :value="vehicle.id" v-for="vehicle in vehicles">{{vehicle.name}}</option>
                                    </select>
                                </form-group-horizontal>
                                
                                <form-group-horizontal :label="'Poliza de Seguro'" name="imagen" :form="form">
                                    <input type="file" id="poliza" ref="image" class="form-control" @change="changeFile(... arguments,'poliza')" required />
                                </form-group-horizontal>
                                
                                <form-group-horizontal :label="'Tarjeta de Circulacion'" name="imagen" :form="form">
                                    <input type="file" id="tarjeta" ref="image" class="form-control" @change="changeFile(... arguments,'tarjeta')" required />
                                </form-group-horizontal>
                                
                                <form-group-horizontal :label="'Licencia'" name="imagen" :form="form">
                                    <input type="file" id="licencia" ref="image" class="form-control" @change="changeFile(... arguments,'licencia')" required />
                                </form-group-horizontal>

                                <div v-if="form.data.insurance_policy && form.data.circulation_card && form.data.license">
                                    <form-group-horizontal v-show="title == 'Editar Usuario'" :label="'Poliza de seguro'" name="poliza" :form="form">
                                        <img style="width: 100%" :src="`/${form.data.insurance_policy}`">
                                    </form-group-horizontal>

                                    <form-group-horizontal v-show="title == 'Editar Usuario'" :label="'Tarjeta de Circulación'" name="tarjeta" :form="form">
                                        <img style="width: 100%" :src="`/${form.data.circulation_card}`">
                                    </form-group-horizontal>

                                    <form-group-horizontal v-show="title == 'Editar Usuario'" :label="'Licencia'" name="licencia" :form="form">
                                        <img style="width: 100%" :src="`/${form.data.license}`">
                                    </form-group-horizontal>
                                </div>
                                


                            </div>

                            <form-group-horizontal v-show="title == 'Editar Usuario'" :label="'Foto'" name="foto" :form="form">
                                <img style="width: 100%" :src="`/${form.data.photo}`">
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
            extensiones : ['jpg', 'jpeg', 'png', 'gif', 'pdf'],
            formData: new FormData(),
            types: [],
            vehicles: [],
            businesses: [],
        }
    }, 
    props: {
        title: { default: 'Nuevo Usuario'},
        business_id: { default: false },
        form: { type: Object, required: true },
    },
    computed: {
        isSendenBoy: function() {
            return _.find(this.types, {'id': this.form.data.user_type_id, 'name': 'Sendenboy'}) ? true : false;
        }
    },

    created() {
        this.fetchUserTypes();
        this.fetchVehicles();
        if (!this.business_id) {
            this.fetchBusinesses();
        }
    },

    methods: { 
        fetchBusinesses() {
            this.$http.get(`businessesData`)
                .then(response => {
                    this.businesses = response.data.businesses;
                })
                .catch(response => {
                    this.form.failProcessing(response.data);
                });
        },
        fetchUserTypes() {
            this.$http.get(`user-types`)
                .then(response => {
                    this.types = response.data.types;
                })
                .catch(response => {
                    this.form.failProcessing(response.data);
                });
        },
        fetchVehicles() {
            this.$http.get(`vehicles`)
                .then(response => {
                    this.vehicles = response.data.vehicles;
                })
                .catch(response => {
                    this.form.failProcessing(response.data);
                });
        },
        changeFile(e, tipo) {    
            let file = e.target.files[0];
            if (file != undefined) {
                if (tipo == 'foto') {
                    this.form.data.imageFile = file;
                    
                } else if (tipo == 'poliza') {
                    this.form.data.polizaFile = file;
                    
                } else if (tipo == 'tarjeta') {
                    this.form.data.tarjetaFile = file;
                    
                } else if (tipo == 'licencia') {
                    this.form.data.licenciaFile = file;                    
                }
            }
            let extension = _.split(file.name, '.', 2)[1];
            if($.inArray(extension, this.extensiones) == -1) {
                console.log(Notify);
                Notify.overlay('Solo son admitidos archivos con extensión <strong>jpg, jpeg, png, pdf y gif</strong>', 'warning');
            }
        },

        close() {
            $('input#image').val(''); 
            $('input#poliza').val(''); 
            $('input#tarjeta').val(''); 
            $('input#licencia').val('');  
            this.$emit('cancel');
        },

        submit() {
            this.formData.append('nombre', this.form.data.name);
            this.formData.append('negocio', this.business_id || this.form.data.business_id);
            this.formData.append('email', this.form.data.email);
            this.formData.append('password', this.form.data.password);
            this.formData.append('calle', this.form.data.street);
            this.formData.append('numero_exterior', this.form.data.ext_number);
            this.formData.append('numero_interior', this.form.data.int_number);
            this.formData.append('colonia', this.form.data.colony);
            this.formData.append('municipio', this.form.data.municipality);
            this.formData.append('estado', this.form.data.state);
            this.formData.append('codigo_postal', this.form.data.postal_code);
            this.formData.append('tipo', this.form.data.user_type_id);

            this.formData.append('vehiculo', this.form.data.vehicle_id);
            this.formData.append('banco', this.form.data.bank);
            this.formData.append('clabe', this.form.data.clabe);
            this.formData.append('placas', this.form.data.plate_number);
            this.formData.append('foto', this.form.data.imageFile || this.form.data.photo);
            this.formData.append('poliza', this.form.data.polizaFile || this.form.data.insurance_policy);
            this.formData.append('tarjeta', this.form.data.tarjetaFile || this.form.data.circulation_card);
            this.formData.append('licencia', this.form.data.licenciaFile || this.form.data.license);
            this.title == 'Crear Usuario' ? this.store() : this.update();
        },

        store() {
            /*AppHttpForm.post('users', this.form)
                .then(response => {
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`users`, this.formData, {
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
            /*AppHttpForm.patch(`users/${this.form.data.id}`, this.form)
                .then(response => {
                    response.data.index = this.form.data.index;
                    this.$emit('success', response.data );
                    this.clear();
                });
            */
            this.form.startProcessing();
            this.$http.post(`users/${this.form.data.id}`, this.formData, {
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
