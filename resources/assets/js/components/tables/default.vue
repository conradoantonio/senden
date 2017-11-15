<template>
    <div class="table-responsive mt5">
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4 v-show="canCreate || hasRecords">Opciones <span class="semi-bold">adicionales</span></h4>
                        <div style="margin-bottom: 10px" class="text-center">            
                            <button v-show="canExcel" type="button" class="btn" id="download_excel_default" @click="$emit('templateProducts')"><i class="fa fa-table" aria-hidden="true"></i> Plantilla Excel</button>
                            <button v-show="hasRecords && canExcel" type="button" class="btn btn-info" id="exportar_excel" @click="$emit('export')"><i class="fa fa-download" aria-hidden="true" ></i> Exportar</button>
                            <button v-show="canExcel" type="button" class="btn btn-success" data-toggle="modal" data-target="#importar-excel" @click="$emit('import')"><i class="fa fa-file-excel-o" aria-hidden="true" ></i> Importar</button>
                            <button v-show="canCreate" type="button" class="btn btn-primary" @click="$emit('create')" data-toggle="modal" data-target="#formulario_producto" id="nuevo_producto"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
                            <app-delete-selections v-show="hasRecords" @click="$emit('delete_multiple')" id="eliminar_varios"></app-delete-selections>
                        </div>
                        <div class="grid-body ">

                            <table ref="datatable" class="table table-condensed table-hover">
                                <slot></slot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Bus from './../../bus';

    export default {
        props: {
            name: { type: String, default: 'table' },
            hasRecords: { default: false },
            canExcel: {default: false},
            canCreate: {default: true}
        },

        mounted() {
            Bus.$on(`${this.name}-ready`, (config = {"language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }}) => {
                $(this.$refs.datatable).DataTable(config);
            });
        }
    }
</script>
