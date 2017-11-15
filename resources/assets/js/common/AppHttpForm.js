import Vue from 'vue';
import Notify from './Notify';
import Promise from 'promise';

export default {
    /**
     * A few helper methods for making HTTP requests and doing common form actions.
     */
    post: function (uri, form, options) {
        return this.sendForm('post', uri, form, options);
    },

    patch: function (uri, form, options) {
        return this.sendForm('patch', uri, form, options);
    },

    delete: function (uri, form, options) {
        return this.sendForm('delete', uri, form, options);
    },

    /**
     * Send the form to the back-end server. Perform common form tasks.
     *
     * This function will automatically clear old errors, update "busy" status, etc.
     */
    sendForm: (method, uri, form, options = {}) => {
        return new Promise((resolve, reject) => {
            form.startProcessing();
            const data = form.hasOwnProperty('customData') ? form.customData : form.data;
            const args = method === 'delete' ? [uri, options] : [uri, data, options];
            Vue.http[method].apply(Vue.http, args)
                .then(response => {
                    form.successProcessing();

                    if (options.notify !== false) {
                        const message = typeof options.notify === 'string' ? options.notify : response.data.message;
                        Notify.success(message);
                    }

                    resolve(response);
                })
                .catch(response => {
                    const errors = response.status === 422 ? response.data.errors : {};
                    form.failProcessing(errors);

                    reject(response);
                });
        });
    }
}
