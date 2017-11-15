<template>
    <div class="input-group date">
        <input ref="input" type="text" class="form-control">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </div>
    </div>
</template>

<script>

    export default {
        props:{
            value: { required: true },
        },

        mounted: function() {
            var vm = this;

            $(this.$el).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked'
            });

            $(this.$el)
                .datepicker('setDate', this.value)
                .on('changeDate', function () {
                    vm.$emit('input', $(vm.$refs.input).val())
                });
        },

        watch: {
            value: function (value, oldValue) {
                if(! _.isEqual(value, oldValue)){
                    $(this.$el).datepicker('setDate', value).trigger('changeDate');
                }
            }
        },

        destroyed: function () {
            $(this.$el).off().datepicker('destroy');
        }
    }
</script>