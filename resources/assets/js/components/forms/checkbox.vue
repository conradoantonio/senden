<template>
    <div class="checkbox">
        <label>
            <input type="checkbox" :checked="value" @change="$emit('input', $event.target.checked)">
            {{ label }}
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            value: { required: true },
            label: { type: String, default: ' ' },
        }
    }
</script>
