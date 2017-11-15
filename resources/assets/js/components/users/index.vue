<template>
	<div>
        <app-users-modal 
            :title="title" 
            :form="form"
            @success="success"
            @cancel="clear"
            :business_id="business_id"
        ></app-users-modal>
        
        <app-table name="users-table" 
                    :hasRecords="hasRecords"
                    @export="exportRecords"
                    @import="importRecords"
                    @create="createNew"
                    @delete_multiple="delete_multiple"
                    >
            <thead>
                <tr>
                    <th class="small-cell"></th>
                    <th><strong>Nombre</strong></th>
                    <th><strong>Email</strong></th>
                    <th><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input :id="'checkbox'+user.id" type="checkbox" class="checkDelete" @change="changeSelections(...arguments, user.id, index)">
                            <label :for="'checkbox'+user.id"></label>
                        </div>
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <app-edit-button @click="edit(user, index)"></app-edit-button>
                        <form-record-delete @deleteRecord="destroy(...arguments, index)" :record="user.id" :display="user.name"></form-record-delete>
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
                    vehicle_id: 0,
                    business_id: 0,
                    user_type_id: 0,
                    name: '',
                    email: '',
                    password: '',
                    photo: null,
                    street: '',
                    ext_number: 0,
                    int_number: 0,
                    colony: '',
                    municipality : '',
                    state : '',
                    postal_code: '',
                    user_type_id: 0,
                    imageFile: null,
                    insurance_policy: null,
                    polizaFile: null,
                    circulation_card: null,
                    licenciaFile: null,
                    license: null,
                    tarjetaFile: null,
                }),
                selections: [],
                title: '',
                currentuser: null,
	        }
	    },

	    props: {
            users: { required: true },
            business_id: { default: false }
	    },

        mounted() {
            if (this.users.length > 0) {
                this.hasRecords = true;
            }
            this.$nextTick(() => {
                Bus.$emit('users-table-ready');
            });
        },

	    methods: {
            createNew() {  
                this.title = 'Crear Usuario';   
                this.clear();         
                $('#modalUser').modal('show');
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
                this.currentuser = null;
                this.form.setData({
                    business_id: 0,
                    vehicle_id: 0,
                    user_type_id: 0,
                    name: '',
                    email: '',
                    password: '',
                    photo: null,
                    street: '',
                    ext_number: 0,
                    int_number: 0,
                    colony: '',
                    municipality : '',
                    state : '',
                    postal_code: '',
                    user_type_id: 0,
                    imageFile: null,
                    insurance_policy: null,
                    polizaFile: null,
                    circulation_card: null,
                    licenciaFile: null,
                    license: null,
                    tarjetaFile: null,
                });
            },

            success(user) {
                if (user.index === undefined) {
                    this.users.push(user);
                } else {
                    this.users[user.index] = user;
                }
                this.clear();
            },

            edit(user, index) {
                this.title = 'Editar Usuario';
                user.index = index;
                this.form.setData(_.cloneDeep(user));
                $('#modalUser').modal('show');
            },

            destroy(id, form, index) {
                AppHttpForm.delete(`users/${id}`, form)
                    .then(response => {
                        window.location.reload();
                    });
            },
            delete_multiple(selections) {
                this.form.customData = {
                    ids : this.selections
                };
                AppHttpForm.post(`users/delete-multiple`, this.form)
                    .then(response => {
                        window.location.reload();
                    });
            }
	    }
	}
</script>
