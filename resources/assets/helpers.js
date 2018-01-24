const ModularScale = require('modular-scale')
const Color = require('color')

export const ms = () => {
    let modularScale = ModularScale({
        rations: [1.3333],
        bases:   [1],
    });

    return modularScale(value) * 16 + 'px'
}

export const hsv = (hue, saturation, value) => {
    return Color({ h: hue, s: saturation, v: value }).rgb().string()
}


