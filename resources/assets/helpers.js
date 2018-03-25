const Color = require('color')

module.exports = {
    hsv: (h, s, v) => {
        return Color({ h, s, v }).rgb().string()
    },
}
