<?php

namespace IsaEken\Color\Color;

use IsaEken\Color\ColorInterface;
use IsaEken\Color\Contrast;
use IsaEken\Color\Convert;
use IsaEken\Color\Traits\Convertable;
use JetBrains\PhpStorm\Pure;

class Hsl implements ColorInterface
{
    use Convertable;

    /**
     * @param float $hue
     * @param float $saturation
     * @param float $lightness
     */
    public function __construct(
        protected float $hue,
        protected float $saturation,
        protected float $lightness,
    )
    {
        // ...
    }

    /**
     * @param string $string
     * @return static
     */
    public static function fromString(string $string): static
    {
        $matches = null;
        preg_match('/hsl\( *(-?\d{1,3}) *, *(\d{1,3})%? *, *(\d{1,3})%? *\)/i', $string, $matches);
        return new static($matches[1], $matches[2], $matches[3]);
    }

    public function hue(): float
    {
        return $this->hue;
    }

    public function saturation(): float
    {
        return $this->saturation;
    }

    public function lightness(): float
    {
        return $this->lightness;
    }

    #[Pure] public function red(): int
    {
        return Convert::hslValueToRgb($this->hue, $this->saturation, $this->lightness)[0];
    }

    #[Pure] public function green(): int
    {
        return Convert::hslValueToRgb($this->hue, $this->saturation, $this->lightness)[1];
    }

    #[Pure] public function blue(): int
    {
        return Convert::hslValueToRgb($this->hue, $this->saturation, $this->lightness)[2];
    }

    public function contrast(): self
    {
        return Contrast::make($this->toHex())->toHsl();
    }

    public function name(): string
    {
        return '';
    }

    public function __toString(): string
    {
        $hue = round($this->hue);
        $saturation = round($this->saturation);
        $lightness = round($this->lightness);

        return "hsl({$hue},{$saturation}%,{$lightness}%)";
    }
}
