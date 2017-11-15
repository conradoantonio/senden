<template>
	<input type="checkbox" :checked="value" 
        data-on-text="YES"
        data-off-text="NO"/>
</template>
<script>

	export default {
		props:{
			value: { required: true }
		},

		mounted: function() {
			var vm = this;
            $(this.$el)
            	.bootstrapSwitch()
        		.on('switchChange.bootstrapSwitch', function () {
					vm.$emit('input', $(this).prop('checked'))
				});

		},
		watch: {
			value: function(value, oldValue){
				if(! _.isEqual(value, oldValue)){
					$(this.$el).bootstrapSwitch('state', value, true);
				}
			}
		},
		destroyed: function(){
			$(this.$el).bootstrapSwitch('destroy')
		}
	}
</script>