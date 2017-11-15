<template>
	<div>
        <app-products-modal 
            :title="title" 
            :form="form"
            @success="success"
            @cancel="clear"
        ></app-products-modal>

        <app-modal-import
            :form="form"
            :path="path"
            :propsExcel="propsExcel"
            @cancel="clear"
        ></app-modal-import>
        
        <app-table name="products-table" 
                    :hasRecords="hasRecords"
                    @export="exportRecords"
                    @import="importRecords"
                    @templateProducts="downloadTemplate"
                    @create="createNew"
                    @delete_multiple="delete_multiple"
                    :canExcel="true"
                    >
            <thead>
                <tr>
                    <th class="small-cell"></th>
                    <th><strong>Nombre</strong></th>
                    <th><strong>Precio</strong></th>
                    <th><strong>Stock</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Foto</strong></th>
                    <th><strong>Acciones</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input :id="'checkbox'+product.id" type="checkbox" class="checkDelete" @change="changeSelections(...arguments, product.id, index)">
                            <label :for="'checkbox'+product.id"></label>
                        </div>
                    </td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                    <td>
                        <span v-if="product.status == 2" class="badge">Pendiente</span>
                        <span v-if="product.status == 1" class="badge badge-info">Aprobado</span>
                        <span v-if="product.status == 0" class="badge badge-important">Rechazado</span>
                    </td>
                    <td><img style="max-width: 50px;" :src="`${b_url}/${product.photo}`"></td>
                    <td>
                        <app-edit-button @click="edit(product, index)"></app-edit-button>
                        <form-record-delete @deleteRecord="destroy(...arguments, index)" :record="product.id" :display="product.name"></form-record-delete>
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
                    vehicle_id: null,
                    name: '',
                    description: '',
                    file: null,
                    price: '',
                    stock: '',
                    weight: null,
                    lenght: '',
                    height: '',
                    width: '',
                    is_best_seller: '',
                    in_promotion: '',
                    all_day: '',
                    istop20: '',
                }),
                selections: [],
                title: '',
                currentproduct: null,
                propsExcel: 'nombre, descripcion, foto, precio, stock, peso, largo, alto, ancho, metodo_entrega, mas_vendido, en_promocion, 24_hrs, istop20',
	            path: 'products',
            }
	    },

	    props: {
	    	products: { required: true }
	    },
        
        computed: {
            b_url: function () { return window.b_url; }
        },

        mounted() {
            if (this.products.length > 0) {
                this.hasRecords = true;
            }
            this.$nextTick(() => {
                Bus.$emit('products-table-ready');
            });
        },

	    methods: {
            createNew() {
                this.clear();      
                this.title = 'Crear producto';
                $('#modalProduct').modal('show');
            },

            exportRecords() {
                window.location.href = window.location.href + '/export/excel';
            },

            downloadTemplate() {
                window.location.href = window.location.href + '/download/template';
            },

            importRecords() { 
                $('#importExcel').modal('show');
            },

            changeSelections(e, id, index) { 
                if (!e.srcElement.checked) {
                    let indice = this.selections.indexOf(id);
                    /*console.warn('se deseleccionó el id: ' + id)
                    console.log('El indice de este id es:' + indice);*/
                    this.selections.splice(indice, 1);

                    //_.remove(this.selections, selection => selection == id );
                } else {
                    //console.warn('se seleccionó el id: ' + id)
                    this.selections.push(id);
                }
                //console.log(this.selections);
            },

            clear() {
                $('input#image').val('');  
                this.currentproduct = null;
                this.form.setData({
                    id: 0,
                    vehicle_id: null,
                    name: '',
                    description: '',
                    file: null,
                    price: '',
                    stock: '',
                    weight: null,
                    lenght: '',
                    height: '',
                    width: '',
                    is_best_seller: '',
                    in_promotion: '',
                    all_day: '',
                    istop20: '',
                });
            },

            success(product) {
                if (product.index === undefined) {
                    this.products.push(product);
                } else {
                    this.products[product.index] = product;
                }
                this.clear();
            },

            edit(product, index) {
                /*let start = _.split(product.start_selling, ':', 3);
                let end = _.split(product.end_selling, ':', 3);*/
                this.title = 'Editar producto';
                product.index = index;
                //product.timeRange = [new Date(2016, 10, 10, start[0], start[1], start[2]),new Date(2016, 10, 10, end[0], end[1], end[2])];
                this.form.setData(_.cloneDeep(product));
                var img_url = this.form.data.photo;// $('#product-details').find('img').attr('src');
                this.form.data.photo = baseUrl+'/'+img_url;
                $('#modalProduct').modal('show');
                $('#modalProduct').on('shown.bs.modal', function () {
                    //console.log($( "#time_picker" ));
                    $( "#time_picker" ).focus();
                })
            },

            destroy(id, form, index) {
                AppHttpForm.delete(`products/${id}`, form)
                    .then(response => {
                        window.location.reload();
                    });
            },
            delete_multiple(selections) {
                this.form.customData = {
                    ids : this.selections
                };
                AppHttpForm.post(`products/delete-multiple`, this.form)
                    .then(response => {
                        window.location.reload();
                    });
            }
	    }
	}
</script>
