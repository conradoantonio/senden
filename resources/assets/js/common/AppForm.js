import AppFormErrors from './AppFormErrors';

export default class {
    /**
     * Constructor.
     */
    constructor(data, options = {}) {
        this.original = _.cloneDeep(data);
        this.data = data;
        this.options = options;
        this.errors = new AppFormErrors();
        this.busy = false;
        this.successful = false;
    }

    /**
     * Reset the form to its original data.
     */
    setData(data) {
        this.data = data;
        this.errors.forget();
        this.syncOriginal();
    }

    /**
     * Reset the form to its original data.
     */
    resetToOriginal() {
        this.errors.forget();
        this.data = _.cloneDeep(this.original);
    }

    /**
     * Sync the original data with the current.
     */
    syncOriginal() {
        this.original = _.cloneDeep(this.data);
    }

    /**
     * Start processing the form.
     */
    startProcessing() {
        this.errors.forget();
        this.busy = true;
        this.successful = false;
    }

    /**
     * Success form processing.
     */
    successProcessing() {
        this.syncOriginal();
        this.busy = false;
        this.successful = true;
    }

    /**
     * Failed form processing.
     */
    failProcessing(errors) {
        console.log('failprocessing');
        this.errors.setErrors(errors);
        this.busy = false;
    }
}
