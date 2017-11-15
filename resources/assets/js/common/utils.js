// Map a recource to its id.
export const getIds = resource => resource.id;

// Transform a collection into a valid param for select2 options.
export const select2options = (collection, textColumn, idColumn = 'id') => {
    return collection.map((resource) => {
        if (typeof resource === 'string') {
            return { 'id': resource, 'text': resource };
        }
        return { 'id': resource[idColumn], 'text': resource[textColumn] };
    });
}

// Capitalize a string.
export const capitalize = value => {
    if (! value) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
}

// Replace text in locale strings.
export const localeReplace = (locale, replacements) => {
    _.forEach(replacements, (replacement, key) => {
        locale = locale.replace(`:${key}`, `<strong>${replacement}</strong>`);
    });

    return locale;
}

// Implode collection. Map then join
export const implode = (collection, iteratee, glue = ', ') => {
    return _.map(collection, iteratee).join(glue);
}

export const templateInput = (type) => {
    const available = [
        'text', 'email', 'file', 'integer', 'numeric', 'paragraph', 'textarea', 'date',
        'heading', 'rich_text', 'agreement', 'yes_no', 'picklist', 'multiple_picklist',
        'currency', 'quickbooks',
    ];
    
    type = available.indexOf(type) > -1 ? type : 'text';
    
    return `template-input-${type}`;
}
