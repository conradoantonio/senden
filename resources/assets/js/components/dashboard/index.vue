<template>
	<div>
        <div class="row" id="data_user_admin">
            <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom text-left">
                <div class="tiles green added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title"> Empresas </div>
                        <div class="heading"> <span class="animate-number" :data-value="dashboard.total_bussinesses" data-animation-duration="1000">0</span> </div>
                        <div class="progress transparent progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">Registradas en el panel</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom text-left">
                <div class="tiles blue added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title"> Total de usuarios </div>
                        <div class="heading"> <span class="animate-number" :data-value="dashboard.app_users" data-animation-duration="1200">0</span> </div>
                        <div class="progress transparent progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%"></div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">Registrados en la aplicación</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 spacing-bottom text-left">
                <div class="tiles red added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title"> Usuarios bloqueados </div>
                        <div class="heading"> <span class="animate-number" :data-value="dashboard.banned_app_users" data-animation-duration="1200">0</span> </div>
                        <div class="progress transparent progress-white progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" :data-percentage="dashboard.banned_app_percent" ></div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">{{dashboard.banned_app_percent}} usuarios totales (app) </span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tiles purple added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                            <div class="tiles-title"> Ventas totales </div>
                            <div class="row-fluid">
                            <div class="heading"> <span class="animate-number" :data-value="dashboard.banned_app_users" data-animation-duration="700">0</span> </div>
                            <div class="progress transparent progress-white progress-small no-radius">
                                <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%"></div>
                            </div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">De todos los negocios</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center col-sm-6 col-xs-12">
            <canvas id="myChart" height="200" width="400"></canvas>  
        </div>
    </div>
</template>

<script>	
    import AppForm from './../../common/AppForm';
    import AppHttpForm from './../../common/AppHttpForm';
    import Notify from './../../common/Notify';
    import Bus from './../../bus';

	export default {

	    data() {
	        return {
            }
	    },

	    props: {
	    	dashboard: { required: true }
	    },
	}
</script>
