<template>
    <div class="form-group" :class="{'has-error': form.errors.has(name)}">
        <label class="control-label">{{ label }}</label>
        <slot></slot>
        <span class="help-block" v-show="form.errors.has(name)">
            <span>{{ form.errors.first(name) }}</span>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            label: { type: String, required: true },
            name: { type: String, required: true },
            form: { type: Object, required: true },
        }
    }
</script>
