export default class {
    /**
     * Constructor.
     */
    constructor(errors = {}) {
        this.errors = errors;
    }

    /**
     * Determine if the collection has any errors.
     */
    hasErrors() {
        return ! _.isEmpty(this.errors);
    }

    /**
     * Determine if the collection has errors for a given field.
     */
    has(field) {
        return _.indexOf(_.keys(this.errors), field) > -1;
    }

    /**
     * Get all of the raw errors for the collection.
     */
    all() {
        return this.errors;
    }

    /**
     * Get all of the errors for the collection in a flat array.
     */
    flatten() {
        return _.flatten(_.toArray(this.errors));
    }

    /**
     * Get the first error message for a given field.
     */
    first(field) {
        if (this.has(field)) {
            return this.errors[field][0];
        }
    }

    /**
     * Set the raw errors for the collection.
     */
    setErrors(errors) {
        this.errors = errors;
    }

    /**
     * Forget all of the errors currently in the collection.
     */
    forget() {
        this.errors = {};
    }
}
