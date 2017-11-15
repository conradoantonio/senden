<template>
  <el-time-picker
    :is-range="isRange"
    @change="change"
    v-model="value3"
    :value="value"
    
    :picker-options="{selectableRange: '00:00:00 - 23:59:59'}"
    :placeholder="placeholder">

  </el-time-picker>
</template>

<script>
  export default {
    data() {
      return {
        value3: [new Date(2016, 9, 0, 0, 0), new Date(2016, 9, 23, 59, 59)]
      }
    },
    props: {
      placeholder: { default: 'Selecciona una hora' },
      isRange: { default: false },
      value: {}
    },
    methods: {
      change(val) {
        let values = _.split(val, ' - ', 2);
        this.$emit('change', values);
      }
    }
  }
</script>