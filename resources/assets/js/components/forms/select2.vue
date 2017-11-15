<style scoped>
	select {
		min-width: 250px;
	}
</style>

<template>
	<select class="form-control" :required="required" :multiple="multiple">
    	<slot></slot>	
    </select> 
</template>

<script>

	export default {
		props:{
			value: { required: true },
			options: { required: true },
			required: { type: Boolean, default: false },
			multiple: { type: Boolean, default: false },
		},

		mounted: function() {
			var vm = this;

			$(this.$el)
				.val(this.value)
				.select2({ data: this.options })
				.on('change', function () {
					vm.$emit('input', $(this).val())
				});
		},

		watch: {
			value: function (value, oldValue) {
				if(! _.isEqual(value, oldValue)){
					$(this.$el).val(value).trigger('change');
				}
			},

			options: function (options) {
				$(this.$el).select2({ data: options });
			}
		},

		destroyed: function () {
			$(this.$el).off().select2('destroy');
		}
	}
</script>