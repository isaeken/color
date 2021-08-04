<?php

namespace IsaEken\Color\Color;

use IsaEken\Color\ColorInterface;
use IsaEken\Color\Contrast;
use IsaEken\Color\Traits\Convertable;

class Rgb implements ColorInterface
{
    use Convertable;

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     */
    public function __construct(
        protected int $red,
        protected int $green,
        protected int $blue,
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
        preg_match('/rgb\( *(\d{1,3} *, *\d{1,3} *, *\d{1,3}) *\)/i', $string, $matches);
        $channels = explode(',', $matches[1]);
        [$red, $green, $blue] = array_map('trim', $channels);
        return new static($red, $green, $blue);
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

    public function contrast(): static
    {
        return Contrast::make($this->toHex())->toRgb();
    }

    public function name(): string
    {
        return $this->toHex()->name();
    }

    public function __toString(): string
    {
        return "rgb({$this->red},{$this->green},{$this->blue})";
    }
}
