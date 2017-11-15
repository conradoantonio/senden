<template>
	<div>
        <app-businesses-modal 
            :title="title" 
            :form="form"
            @success="success"
            @cancel="clear"
        ></app-businesses-modal>
        
        <app-table name="businesses-table" 
                    :hasRecords="hasRecords"
                    @export="exportRecords"
                    @import="importRecords"
                    @create="createNew"
                    @delete_multiple="delete_multiple"
                    >
            <thead>
                <tr>
                    <th class="small-cell"></th>
                    <th><strong>Nombre Comercial</strong></th>
                    <th><span class="sr-only">Acciones</span></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(business, index) in businesses">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input :id="'checkbox'+business.id" type="checkbox" class="checkDelete" @change="changeSelections(...arguments, business.id, index)">
                            <label :for="'checkbox'+business.id"></label>
                        </div>
                    </td>
                    <td>{{ business.tradename }}</td>
                    <td>
                        <app-edit-button @click="edit(business, index)"></app-edit-button>
                        <form-record-delete @deleteRecord="destroy(...arguments, index)" :record="business.id" :display="business.name"></form-record-delete>
                    </td>
                </tr>
            </tbody>
        </app-table>
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
                hasRecords: false,
                form: new AppForm({
                    id: 0,
                    category_id: 0,
                    tradename: '',
                    name: '',
                    rfc: '',
                    street: '',
                    ext_number: '',
                    int_number: '',
                    cp: '',
                    latitude: '',
                    longitude: '',
                    colony: '',
                    city: '',
                    state: '',
                    phone: '',
                    logo: '',
                    photo1: '',
                    photo2: '',
                }),
                selections: [],
                title: '',
                currentBusiness: null,
	        }
	    },

	    props: {
	    	businesses: { required: true }
	    },

        mounted() {
            if (this.businesses.length > 0) {
                this.hasRecords = true;
            }
            this.$nextTick(() => {
                Bus.$emit('businesses-table-ready');
            });
        },

	    methods: {
            createNew() {  
                this.title = 'Crear Negocio';            
                $('#modalBusiness').modal('show');
                $('#modalBusiness').on('shown.bs.modal', function(){
                    let elem = document.getElementById("map");
                    let latitud_mapa = $('#latitud').text();
                    let longitud_mapa = $('#longitud').text();
                    console.log('jeje')
                    center = {lat: parseFloat(latitud_mapa), lng: parseFloat(longitud_mapa)};
                    initMap();
                });
            },

            exportRecords() { 

            },

            importRecords() { 

            },

            changeSelections(e, id, index) {    
                if (!e.srcElement.checked) {
                    _.remove(this.selections, selection => selection == id );
                } else {
                    this.selections.push(id);
                }
            },

            clear() {
                this.currentBusiness = null;
                this.form.setData({
                    id: 0,
                    category_id: 0,
                    tradename: '',
                    name: '',
                    rfc: '',
                    street: '',
                    ext_number: '',
                    int_number: '',
                    cp: '',
                    latitude: '',
                    longitude: '',
                    colony: '',
                    city: '',
                    state: '',
                    phone: '',
                    logo: '',
                    photo1: '',
                    photo2: '',
                });
            },

            success(business) {
                if (business.index === undefined) {
                    this.businesses.push(business);
                } else {
                    this.businesses[business.index] = business;
                }
                this.clear();
            },

            edit(business, index) {
                this.title = 'Editar Negocio';
                business.index = index;
                this.form.setData(_.cloneDeep(business));
                $('#latitud').val(parseFloat(business.latitude));
                $('#longitud').val(parseFloat(business.longitude));
                $('#modalBusiness').modal('show');
                $('#modalBusiness').on('shown.bs.modal', function(){
                    let elem = document.getElementById("map");
                    let latitud_mapa = $('#latitud').val();
                    let longitud_mapa = $('#longitud').val();
                    console.log('jeje')
                    center = {lat: parseFloat(latitud_mapa), lng: parseFloat(longitud_mapa)};
                    initMap();
                });
            },

            destroy(id, form, index) {
                AppHttpForm.delete(`businesses/${id}`, form)
                    .then(response => {
                        window.location.reload();
                    });
            },
            delete_multiple(selections) {
                this.form.customData = {
                    ids : this.selections
                };
                AppHttpForm.post(`businesses/delete-multiple`, this.form)
                    .then(response => {
                        window.location.reload();
                    });
            }
	    }
	}
</script>
