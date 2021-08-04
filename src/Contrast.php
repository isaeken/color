<?php

namespace IsaEken\Color;

use Exception;
use IsaEken\Color\Color\Hex;
use IsaEken\Color\Color\Hsl;
use IsaEken\Color\Color\Hsla;
use IsaEken\Color\Color\Rgb;
use IsaEken\Color\Color\Rgba;

class Contrast
{
    /**
     * @param Hex|Hsl|Hsla|Rgb|Rgba $color
     * @return int
     * @throws Exception
     */
    public static function ratio(Hex|Hsl|Hsla|Rgb|Rgba $color): int
    {
        if (! $color instanceof Hex) {
            $color = $color->toHex();
        }

        $L1 =
            0.2126 * pow(hexdec($color->red()) / 255, 2.2) +
            0.7152 * pow(hexdec($color->green()) / 255, 2.2) +
            0.0722 * pow(hexdec($color->blue()) / 255, 2.2);

        $L2 =
            0.2126 * pow(hexdec('00') / 255, 2.2) +
            0.7152 * pow(hexdec('00') / 255, 2.2) +
            0.0722 * pow(hexdec('00') / 255, 2.2);

        if ($L1 > $L2) {
            return (int) (($L1 + 0.05) / ($L2 + 0.05));
        }
        else {
            return (int) (($L2 + 0.05) / ($L1 + 0.05));
        }
    }

    /**
     * @param Hex|Hsl|Hsla|Rgb|Rgba $color
     * @return Hex
     * @throws Exception
     */
    public static function make(Hsl|Hsla|Hex|Rgba|Rgb $color): Hex
    {
        if (! $color instanceof Hex) {
            $color = $color->toHex();
        }

        if (static::ratio($color) > 5) {
            return Hex::fromString('#000000');
        }
        else {
            return Hex::fromString('#FFFFFF');
        }
    }
}
