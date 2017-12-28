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
