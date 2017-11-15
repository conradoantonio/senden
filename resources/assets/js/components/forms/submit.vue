<template>
    <button
        type="submit"
        class="btn"
        :class="btnClass"
        :disabled="form.busy"
        @click="$emit('click', $event)"
    >
        <i v-if="form.busy" class="fa fa-spinner fa-spin"></i>
        {{ label }}
    </button>
</template>

<script>
    module.exports = {
        props: {
            form: { type: Object, required: true },
            btnClass: { type: String, default: 'btn-primary' },
            label: { type: String, default: 'Enviar' }
        }
    }
</script>
