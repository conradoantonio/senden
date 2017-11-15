import _ from 'lodash';
import $ from 'jquery';
import Vue from 'vue';
import VueResource from 'vue-resource';
import Notify from './common/Notify';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import locale from 'element-ui/lib/locale/lang/es';

//import { DatePicker, TimePicker, TimeSelect } from 'element-datepicker'

//Vue.component('el-date-picker', DatePicker);
//Vue.component('el-time-picker', TimePicker);
//Vue.component('el-time-select', TimeSelect);

Vue.use(ElementUI, { locale });
//require("bootstrap");

window._ = _;
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap-sass');
} catch (e) {}

Vue.use(VueResource);
Vue.http.interceptors.push((request, next) => {
    // Attach the "CSRF" header to each of the outgoing requests.
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    // Process Response
    next(response => {
        if (! response.ok) {
            console.log(response);

            if (response.status === 400) {
                Notify.danger(response.data.message);
            } else if (response.status !== 422) {
                Notify.danger(window.Laravel.locale.notify.error + response.status);
            }
        }
    });
});
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

require('datatables.net');
require('datatables.net-bs');


$(document).ready(function() {
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1]).tab('show');
    } //add a suffix

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e){
        window.location.hash = e.target.hash;
    });

    // Display red asterisk for required inputs
    $(':input[required]')
        .closest('.form-group')
        .children('label')
        .append(' <span class="text-danger">*</span>');


});