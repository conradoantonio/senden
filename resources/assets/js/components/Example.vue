<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!


                        <el-time-picker
                            is-range
                            @change="change"
                            v-model="value2"
                            :picker-options="{
                              selectableRange: '00:00:00 - 23:59:59'
                            }"
                            placeholder="Selecciona una hora">
                        </el-time-picker>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                value2: [new Date(2016, 9, 10, 18, 40), new Date(2016, 9, 10, 20, 40)]
            }
        },
        computed: {
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            change(val) {
                console.log(_.split(val, ' - ', 2));
            }
        }
    }
</script>
