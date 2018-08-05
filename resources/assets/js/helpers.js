/**
 * This is just like Laravel's tap method but, javascript-ified.
 */
export const tap = (object) => {
    return new Proxy(object, {
        get: function (target, attribute) {
            return function (...args) {
                target[attribute].apply(target, args);

                return target;
            };
        },
    });
};

/**
 * An easier way to render JSX stuff without wrapping a method
 * around the templates.
 *
 * @param {Boolean} conditional
 * @param {*} template
 */
export const renderIf = (conditional, template) => {
    if (! conditional)  {
        return null
    }

    return template
}
