<template>
    <button
        type="button"
        class="btn"
        :class="btnClass"
        :disabled="form.busy"
        @click="cancel"
    >
        Cancelar
    </button>
</template>

<script>
    export default {
        props: {
            form: { type: Object, required: true },
            btnClass: { type: String, default: 'btn-default' },
        },

        data() {
            return {
                locale: window.Laravel.locale,
            }
        },

        methods: {
            cancel() {
                this.form.resetToOriginal();
                this.$emit('cancel');
            }
        }
    }
</script>
