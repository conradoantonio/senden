<template>
	<div>
        <app-faqs-modal 
            :title="title" 
            :form="form"
            @success="success"
            @cancel="clear"
        ></app-faqs-modal>
        
        <app-table name="faqs-table" 
                    :hasRecords="hasRecords"
                    @export="exportRecords"
                    @import="importRecords"
                    @create="createNew"
                    @delete_multiple="delete_multiple"
                    >
            <thead>
                <tr>
                    <th class="small-cell"></th>
                    <th><strong>Imagen</strong></th>
                    <th><strong>Pregunta</strong></th>
                    <th><strong>Respuesta</strong></th>
                    <th><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(faq, index) in faqs">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input :id="'checkbox'+faq.id" type="checkbox" class="checkDelete" @change="changeSelections(...arguments, faq.id, index)">
                            <label :for="'checkbox'+faq.id"></label>
                        </div>
                    </td>
                    <td>{{ faq.image }}</td>
                    <td>{{ faq.question }}</td>
                    <td>{{ faq.answer }}</td>
                    <td>
                        <app-edit-button @click="edit(faq, index)"></app-edit-button>
                        <form-record-delete @deleteRecord="destroy(...arguments, index)" :record="faq.id" :display="faq.question"></form-record-delete>
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
                    image: '',
                    question: '',
                    answer: '',
                    file: null,
                }),
                selections: [],
                title: '',
                currentFaq: null,
	        }
	    },

	    props: {
	    	faqs: { required: true }
	    },

        mounted() {
            if (this.faqs.length > 0) {
                this.hasRecords = true;
            }
            this.$nextTick(() => {
                Bus.$emit('faqs-table-ready');
            });
        },

	    methods: {
            createNew() {  
                this.title = 'Crear Faq';            
                $('#modalFaq').modal('show');
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
                this.currentFaq = null;
                this.form.setData({
                    id: 0,
                    image: '',
                    question: '',
                    answer: '',
                });
            },

            success(faq) {
                if (faq.index === undefined) {
                    this.faqs.push(faq);
                } else {
                    this.faqs[faq.index] = faq;
                }
                this.clear();
            },

            edit(faq, index) {
                this.title = 'Editar Faq';
                faq.index = index;
                this.form.setData(_.cloneDeep(faq));
                $('#modalFaq').modal('show');
            },

            destroy(id, form, index) {
                AppHttpForm.delete(`faqs/${id}`, form)
                    .then(response => {
                        window.location.reload();
                    });
            },
            delete_multiple(selections) {
                this.form.customData = {
                    ids : this.selections
                };
                AppHttpForm.post(`faqs/delete-multiple`, this.form)
                    .then(response => {
                        window.location.reload();
                    });
            }
	    }
	}
</script>
