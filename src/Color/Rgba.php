<?php

namespace IsaEken\Color\Color;

use IsaEken\Color\ColorInterface;
use IsaEken\Color\Contrast;
use IsaEken\Color\Traits\Convertable;

class Rgba implements ColorInterface
{
    use Convertable;

    /**
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     * @param float $alpha
     */
    public function __construct(
        protected int $red,
        protected int $green,
        protected int $blue,
        protected float $alpha,
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
        preg_match('/rgba\( *(\d{1,3} *, *\d{1,3} *, *\d{1,3} *, *[0-1](\.\d{1,2})?) *\)/i', $string, $matches);
        $channels = explode(',', $matches[1]);
        [$red, $green, $blue, $alpha] = array_map('trim', $channels);
        return new static($red, $green, $blue, $alpha);
    }

    public function red(): int
    {
        return $this->red;
    }

    public function green(): int
    {
        return $this->green;
    }

    public function blue(): int
    {
        return $this->blue;
    }

    public function alpha(): float
    {
        return $this->alpha;
    }

    public function contrast(): self
    {
        return Contrast::make($this->toHex())->toRgba($this->alpha());
    }

    public function name(): string
    {
        return $this->toHex()->name();
    }

    public function __toString(): string
    {
        $alpha = number_format($this->alpha, 2);
        return "rgba({$this->red},{$this->green},{$this->blue},{$alpha})";
    }
}
