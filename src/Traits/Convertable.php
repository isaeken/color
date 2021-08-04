<?php

namespace IsaEken\Color\Traits;

use Exception;
use IsaEken\Color\Color\Hex;
use IsaEken\Color\Color\Hsl;
use IsaEken\Color\Color\Hsla;
use IsaEken\Color\Color\Rgb;
use IsaEken\Color\Color\Rgba;
use IsaEken\Color\Convert;

trait Convertable
{
    /**
     * Convert color to Hex class.
     *
     * @return Hex
     * @throws Exception
     */
    public function toHex(): Hex
    {
        if ($this instanceof Hex) {
            return new Hex($this->red(), $this->green(), $this->blue());
        }
        else if ($this instanceof Hsl || $this instanceof Hsla || $this instanceof Rgb) {
            return new Hex(
                Convert::rgbChannelToHexChannel($this->red()),
                Convert::rgbChannelToHexChannel($this->green()),
                Convert::rgbChannelToHexChannel($this->blue())
            );
        }
        else if ($this instanceof Rgba) {
            return $this->toRgb()->toHex();
        }

        throw new Exception('Unsupported color conversation.');
    }

    /**
     * Convert color to Hsl.
     *
     * @return Hsl
     * @throws Exception
     */
    public function toHsl(): Hsl
    {
        if ($this instanceof Hex) {
            [$hue, $saturation, $lightness] = Convert::rgbValueToHsl(
                Convert::hexChannelToRgbChannel($this->red),
                Convert::hexChannelToRgbChannel($this->green),
                Convert::hexChannelToRgbChannel($this->blue)
            );

            return new Hsl($hue, $saturation, $lightness);
        }
        else if ($this instanceof Hsl || $this instanceof  Hsla) {
            return new Hsl($this->hue(), $this->saturation(), $this->lightness());
        }
        else if ($this instanceof Rgb || $this instanceof Rgba) {
            [$hue, $saturation, $lightness] = Convert::rgbValueToHsl(
                $this->red,
                $this->green,
                $this->blue
            );

            return new Hsl($hue, $saturation, $lightness);
        }

        throw new Exception('Unsupported color conversation.');
    }

    /**
     * Convert color to Hsla class.
     *
     * @param float $alpha
     * @return Hsla
     * @throws Exception
     */
    public function toHsla(float $alpha = 1): Hsla
    {
        if ($this instanceof Hex) {
            [$hue, $saturation, $lightness] = Convert::rgbValueToHsl(
                Convert::hexChannelToRgbChannel($this->red),
                Convert::hexChannelToRgbChannel($this->green),
                Convert::hexChannelToRgbChannel($this->blue)
            );

            return new Hsla($hue, $saturation, $lightness, $alpha);
        }
        else if ($this instanceof Hsl || $this instanceof Hsla) {
            return new Hsla($this->hue(), $this->saturation(), $this->lightness(), $alpha);
        }
        else if ($this instanceof Rgb || $this instanceof Rgba) {
            [$hue, $saturation, $lightness] = Convert::rgbValueToHsl(
                $this->red,
                $this->green,
                $this->blue
            );

            return new Hsla($hue, $saturation, $lightness, $alpha);
        }

        throw new Exception('Unsupported color conversation.');
    }

    /**
     * Convert color to Rgb class.
     *
     * @return Rgb
     * @throws Exception
     */
    public function toRgb(): Rgb
    {
        if ($this instanceof Hex || $this instanceof Hsl || $this instanceof Hsla || $this instanceof Rgb || $this instanceof Rgba) {
            return new Rgb($this->red(), $this->green(), $this->blue());
        }

        throw new Exception('Unsupported color conversation.');
    }

    /**
     * Convert color to Rgba class.
     *
     * @param float $alpha
     * @return Rgba
     * @throws Exception
     */
    public function toRgba(float $alpha = 1): Rgba
    {
        if ($this instanceof Hex) {
            return $this->toRgb()->toRgba($alpha);
        }
        else if ($this instanceof Hsl || $this instanceof Hsla || $this instanceof Rgb || $this instanceof Rgba) {
            return new Rgba($this->red(), $this->green(), $this->blue(), $alpha);
        }

        throw new Exception('Unsupported color conversation.');
    }
}
