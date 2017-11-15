<style scoped>
    button {
        display: inline-block;
        width: 105px;
    }
</style>

<template>
    <button
        :title="locale.properties.click_toggle"
        class="btn btn-sm"
        :class="btnClass"
        :disabled="form.busy"
        @click="$emit('toggle', resource, form)"
    >
        <span v-if="form.busy">
            <i class="fa fa-spinner fa-spin"></i>
        </span>
        <span v-else>{{ display }}</span>
    </button>
</template>

<script>
    import AppForm from './../../common/AppForm';

    export default {
        props: {
            resource: { type: Object, required: true }
        },

        data() {
            return {
                locale: window.Laravel.locale,
                form: new AppForm()
            }
        },

        computed: {
            btnClass() {
                return this.resource.active ? 'btn-success' : 'btn-warning';
            },

            display() {
                return this.resource.active ? 'Activo' : 'Inactivo' ;
            }
        }
    }
</script>
