<template>
    <div class="form-group" :class="{'has-error': form.errors.has(name) } ">
        <label v-bind:class="'col-md-'+size+' control-label'">{{ label }}</label>
        <div  v-bind:class="'pb-5 col-md-'+ wsize">
            <slot></slot>
            <span class="help-block" v-show="form.errors.has(name)">
                <span>{{ form.errors.first(name) }}</span>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            label: { type: String, default: ' ' },
            name: { type: String, required: true },
            form: { type: Object, required: true },
            size: {type: Number, default: 2},
            wsize: {type: Number, default: 12},
            inline: {type: Boolean, default: false}
        }
    }
</script>
