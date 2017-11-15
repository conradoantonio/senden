<template>
    <button
        type="button"
        class="btn btn-sm"
        :class="btnClass"
        @click="$emit('click', $event)"
    >
        {{ label }}
    </button>
</template>

<script>
    export default {
        props: {
            btnClass: { type: String, default: 'btn-info' },
            label: { type: String, default: 'Editar' }
        }
    }
</script>
