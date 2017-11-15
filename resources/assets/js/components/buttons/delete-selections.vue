<template>
    <button
        class="btn btn-danger"
        :disabled="form.busy"
        @click="deleteRecords"
    >
        <span v-if="form.busy">
            <i class="fa fa-spinner fa-spin"></i> Eliminar seleccion
        </span>
        <span v-else>
            <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar seleccion
        </span>
    </button>
</template>

<script>
    import AppForm from './../../common/AppForm';
    import Notify from './../../common/Notify';

    export default {
        data() {
            return {
                form: new AppForm()
            }
        },

        methods: {
            deleteRecords() {
                const text = _.escape(this.display);

                Notify.confirm(`¿Realmente quieres eliminar la seleccion?`)
                    .then(() => this.$emit('click'));
            }
        }
    }
</script>
