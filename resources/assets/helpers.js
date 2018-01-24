const Color = require('color')
const ModularScale = require('modularscale-js')

module.exports = {
    ms: (value) => {
        return ModularScale(value, {
            base:  [16],
            ratio: 1.3333
        })
    },

    hsv: (h, s, v) => {
        return Color({ h, s, v }).rgb().string()
    },
}
