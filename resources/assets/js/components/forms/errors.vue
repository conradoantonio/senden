<template>
    <ul class="text-danger">
        <li v-for="error in flatErrors">{{ error }}</li>
    </ul>
</template>

<script>
    export default {
        props: {
            form: { type: Object, required: true },
        },

        computed: {
            flatErrors() {
                const errors = this.form.errors.errors;
                
                return _.chain(errors).toArray().flatten().value();
            }
        }
    }
</script>
