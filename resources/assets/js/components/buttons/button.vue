<template>
    <button
        type="button"
        class="btn"
        :class="btnClass"
        @click="$emit('click', $event)"
    >
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            btnClass: { type: String, default: 'btn-default' }
        }
    }
</script>
