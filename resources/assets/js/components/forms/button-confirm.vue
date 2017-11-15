<template>
    <button
        class="btn btn-sm"
        :class="btnClass"
        :disabled="form.busy"
        @click="confirm"
    >
        <i v-if="form.busy" class="fa fa-spinner fa-spin"></i>
        {{ label }}
    </button>
</template>

<script>
    import AppForm from './../../common/AppForm';
    import Notify from './../../common/Notify';

    export default {
        props: {
            record: { type: Number, required: true },
            label: { type: String, required: true },
            message: { type: String, required: true },
            btnClass: { type: String, default: 'btn-default' },
        },

        data() {
            return {
                form: new AppForm()
            }
        },

        methods: {
            confirm() {
                Notify.confirm(this.message)
                    .then(() => this.$emit('confirmed', this.record, this.form));
            }
        }
    }
</script>
