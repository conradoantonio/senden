<template>
    <button
        :class="'btn ' + button_class + ' btn-sm'"
        :disabled="form.busy"
        @click="deleteRecord"
    >
        <span v-if="form.busy">
            <i class="fa fa-spinner fa-spin"></i>
        </span>
        <span v-else>
            <i :class="icon"></i>
        </span>
    </button>
</template>

<script>
    import AppForm from './../../common/AppForm';
    import Notify from './../../common/Notify';

    export default {
        props: {
            record: { type: Number, required: true },
            display: { type: String, required: true },
            text: {default: "¿Realmente quieres eliminar:"},
            icon: {default: "fa fa-times"},
            button_class: {default: "btn-danger"}
        },

        data() {
            return {
                form: new AppForm()
            }
        },

        methods: {
            deleteRecord() {
                const text = _.escape(this.display);

                Notify.confirm(`${this.text}  <strong>${text}</strong>?`)
                    .then(() => this.$emit('deleteRecord', this.record, this.form));
            }
        }
    }
</script>
