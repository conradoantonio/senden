import toastr from 'toastr';
import swal from 'sweetalert';
import Promise from 'promise';


export default {
    success: function (message) {
        this.notify('success', message);
    },

    warning: function (message) {
        this.notify('warning', message);
    },

    error: function (message) {
        this.notify('error', message);
    },

    danger: function (message) {
        return this.overlay(message, 'error');
    },

    notify: function (type, message) {
        toastr[type](message, null, {
            progressBar: true,
            positionClass: 'toast-top-center'
        });
    },

    overlay: function (message, type = 'success') {
        return new Promise((resolve, reject) => {
            swal({
                title: '',
                html: true,
                text: message,
                type: type,
            }, () => resolve());
        });
    },

    confirm: function (message, type = 'warning') {
        return new Promise((resolve, reject) => {
            swal({
                title: '',
                text: message,
                type: type,
                html: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }, confirm => ( confirm ? resolve() : reject() ));
        });
    }
}
