<template>
	<div>
        <div class="modal fade" ref="product-details" id="product-details" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{ title }}</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Nombre: </span>{{form.data.name}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Precio: </span>${{form.data.price}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Stock: </span>{{form.data.stock}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Peso: </span>{{form.data.weight}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Descripción: </span>{{form.data.description}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Largo: </span>{{form.data.lenght}} cm.</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Alto: </span>{{form.data.height}} cm.</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Ancho: </span>{{form.data.width}} cm.</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Vehículo: </span>{{vehicle}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Más vendido: </span>{{form.data.is_best_seller ? "Si" : "No"}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">En promoción: </span>{{form.data.in_promotion ? "Si" : "No"}}</p>
                                </div>
                                <div class="">
                                    <p class="form-control-static"><span class="bold">Disponible 24 horas: </span>{{form.data.all_day ? "Si" : "No"}}</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <img style="width: 100%" :src="`${form.data.photo}`">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <form-record-delete @deleteRecord="destroy(...arguments, 0)" text="¿Realmente desea rechazar el producto" :record="form.data.id" :display="form.data.name"></form-record-delete>
                        <form-record-delete @deleteRecord="destroy(...arguments, 1)" button_class="btn-primary" text="¿Realmente desea aprobar el producto" icon="fa fa-check" :record="form.data.id" :display="form.data.name"></form-record-delete>
                        <button type="button" @click="clear" class="btn btn-default" data-dismiss="modal"> Cerrar </button>
                    </div>
                </div>
            </div>
        </div>
        <app-table name="products-table" 
                    :hasRecords="false"
                    :canCreate="false"
                    @delete_multiple="delete_multiple"
                    >
            <thead>
                <tr>
                    <!-- <th class="small-cell"></th> -->
                    <th><strong>Nombre</strong></th>
                    <th><strong>Precio</strong></th>
                    <th><strong>Stock</strong></th>
                    <th><strong>Negocio</strong></th>
                    <th><strong>Vehículo</strong></th>
                    <th><strong>Foto</strong></th>
                    <th><span class="">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products">
                    <!-- <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input :id="'checkbox'+product.id" type="checkbox" class="checkDelete" @change="changeSelections(...arguments, product.id, index)">
                            <label :for="'checkbox'+product.id"></label>
                        </div>
                    </td> -->
                    <td>{{ product.name }}</td>
                    <td>${{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                    <td>{{ product.business.name }}</td>
                    <td>{{ product.vehicle_name.name }}</td>
                    <td><img style="max-width: 50px;" :src="`${b_url}/${product.photo}`"></td>
                    <td>
                        <app-edit-button @click="edit(product, index)" :label="'ver'" btn-class='btn-success'></app-edit-button>
                        <form-record-delete @deleteRecord="destroy(...arguments, 0)" text="¿Realmente desea rechazar el producto" :record="product.id" :display="product.name"></form-record-delete>
                        <form-record-delete @deleteRecord="destroy(...arguments, 1)" button_class="btn-primary" text="¿Realmente desea aprobar el producto" icon="fa fa-check" :record="product.id" :display="product.name"></form-record-delete>
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
                vehicles: [],
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
                    start_selling: '',
                    end_selling: '',
                    timeRange: [new Date(2016, 9, 10, 0, 0),new Date(2016, 9, 10, 23, 59)]
                }),
                selections: [],
                title: '',
                currentproduct: null,
                propsExcel: 'nombre, descripcion, foto, precio, stock, peso, largo, alto, ancho, metodo_entrega, mas_vendido, en_promocion, inicio_venta, fin_venta.',
	            path: 'products',
            }
	    },

	    props: {
	    	products: { required: true }
	    },
        created() {
            this.fetchVehicles();
        },
        mounted() {
            if (this.products.length > 0) {
                this.hasRecords = true;
            }
            this.$nextTick(() => {
                Bus.$emit('products-table-ready');
            });
        },
        computed: {
            vehicle: function() {
                let vehicle = null;
                vehicle = _.find(this.vehicles, {"id":this.form.data.vehicle_id});
                return vehicle ? vehicle.name : "Indefinido";
            },
            b_url: function () { return window.b_url; }
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

            importRecords() { 
                $('#importExcel').modal('show');
            },

            changeSelections(e, id, index) {
                if (!e.srcElement.checked) {
                    _.remove(this.selections, selection => selection == id );
                } else {
                    this.selections.push(id);
                }
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
                this.title = 'Ver detalles producto';
                product.index = index;
                //product.timeRange = [new Date(2016, 10, 10, start[0], start[1], start[2]),new Date(2016, 10, 10, end[0], end[1], end[2])];
                this.form.setData(_.cloneDeep(product));
                var img_url = this.form.data.photo;// $('#product-details').find('img').attr('src');
                this.form.data.photo = baseUrl+'/'+img_url;
                $('#product-details').modal('show');
            },

            destroy(id, form, validation) {
                form.customData = {validation: validation};
                AppHttpForm.post(`../products/validate/${id}`, form)
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
            },
            fetchVehicles() {
                this.$http.get(`../vehicles`)
                    .then(response => {
                        this.vehicles = response.data.vehicles;
                    })
                    .catch(response => {
                        this.form.failProcessing(response.data);
                    });
            }
	    }
	}
</script>
