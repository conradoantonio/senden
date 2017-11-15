import Vue from 'vue';

// Form
Vue.component('form-horizontal', require('./components/forms/form-horizontal.vue'));
Vue.component('form-group-horizontal', require('./components/forms/group-horizontal.vue'));
Vue.component('form-actions-horizontal', require('./components/forms/actions-horizontal.vue'));
Vue.component('form-inline', require('./components/forms/form-inline.vue'));
Vue.component('form-group-inline', require('./components/forms/group-inline.vue'));
Vue.component('form-actions-inline', require('./components/forms/actions-inline.vue'));
Vue.component('form-submit', require('./components/forms/submit.vue'));
Vue.component('form-cancel', require('./components/forms/cancel.vue'));
Vue.component('form-record-delete', require('./components/forms/record-delete.vue'));
Vue.component('form-button-confirm', require('./components/forms/button-confirm.vue'));
Vue.component('form-select2', require('./components/forms/select2.vue'));
Vue.component('form-select2-on-the-fly', require('./components/forms/select2-on-the-fly.vue'));
Vue.component('form-switch', require('./components/forms/switch.vue'));
Vue.component('form-checkbox', require('./components/forms/checkbox.vue'));
Vue.component('form-datepicker', require('./components/forms/datepicker.vue'));
Vue.component('form-errors', require('./components/forms/errors.vue'));
Vue.component('resource-activable', require('./components/forms/activable.vue'));

// Button
Vue.component('app-button', require('./components/buttons/button.vue'));
Vue.component('app-edit-button', require('./components/buttons/edit-button.vue'));
Vue.component('app-delete-selections', require('./components/buttons/delete-selections.vue'));

// Element-ui
Vue.component('app-time-picker', require('./components/elementui/timepicker.vue'));

// Tables
Vue.component('app-table', require('./components/tables/default.vue'));

//             Tag-name                 path del archivo del componente
//				cambiar {faqs}                         {faqs}

// Dashboard Admin Panel
Vue.component('app-dashboard-index', require('./components/dashboard/index.vue'));

// Faqs
Vue.component('app-faqs-index', require('./components/faqs/index.vue'));
Vue.component('app-faqs-modal', require('./components/faqs/modal.vue'));

//Products
Vue.component('app-products-index', require('./components/products/index.vue'));
Vue.component('app-products-approve', require('./components/products/approve.vue'));
Vue.component('app-products-modal', require('./components/products/modal.vue'));

// Users
Vue.component('app-users-index', require('./components/users/index.vue'));
Vue.component('app-users-modal', require('./components/users/modal.vue'));

// Businesses
Vue.component('app-businesses-index', require('./components/businesses/index.vue'));
Vue.component('app-businesses-modal', require('./components/businesses/modal.vue'));

// Business Service Dates
Vue.component('app-business-dates-index', require('./components/businessDates/index.vue'));
Vue.component('app-business-dates-modal', require('./components/businessDates/modal.vue'));

// Business Holidays
Vue.component('app-holidays-index', require('./components/holidays/index.vue'));
Vue.component('app-holidays-modal', require('./components/holidays/modal.vue'));

// Solutions
Vue.component('app-solutions-index', require('./components/solutions/index.vue'));
Vue.component('app-solutions-modal', require('./components/solutions/modal.vue'));

// Modals
Vue.component('app-modal-import', require('./components/modals/import.vue'));
