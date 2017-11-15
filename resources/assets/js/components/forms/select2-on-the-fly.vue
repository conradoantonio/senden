<style scoped>
    select {
        min-width: 250px;
    }
</style>

<template>
    <select class="form-control" multiple>
        <slot></slot>
    </select> 
</template>

<script>

    export default {
        props:{
            value: { required: true },
            options: { required: true },
        },

        mounted: function() {
            var vm = this;

            $(this.$el)
                .val(this.value)
                .select2({
                    data: this.options,
                    tags: true
                })
                .on('change', function () {
                    vm.$emit('input', $(this).val())
                })
        },

        watch: {
            value: function (value, oldValue) {
                if(! _.isEqual(value, oldValue)){
                    $(this.$el).val(value).trigger('change');
                }
            },

            options: function (options) {
                $(this.$el).select2({
                    data: options,
                    tags: true
                });
            }
        },

        destroyed: function () {
            $(this.$el).off().select2('destroy');
        }
    }
</script>