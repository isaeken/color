<?php

namespace IsaEken\Color\Color;

use Illuminate\Support\Str;
use IsaEken\Color\ColorInterface;
use IsaEken\Color\Contrast;
use IsaEken\Color\Enums\Colors;
use IsaEken\Color\Traits\Convertable;
use JetBrains\PhpStorm\Pure;

class Hex implements ColorInterface
{
    use Convertable;

    /**
     * @param string $red
     * @param string $green
     * @param string $blue
     */
    public function __construct(
        protected string $red,
        protected string $green,
        protected string $blue,
    )
    {
        $this->red = strtolower($this->red);
        $this->green = strtolower($this->green);
        $this->blue = strtolower($this->blue);
    }

    /**
     * @param string $string
     * @return static
     */
    #[Pure] public static function fromString(string $string): static
    {
        return new static(...str_split(ltrim($string, '#'), 2));
    }

    /**
     * @return string
     */
    public function red(): string
    {
        return $this->red;
    }

    /**
     * @return string
     */
    public function green(): string
    {
        return $this->green;
    }

    /**
     * @return string
     */
    public function blue(): string
    {
        return $this->blue;
    }

    /**
     * @return string
     */
    public function contrast(): string
    {
        return Contrast::make($this);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        $hex = Str::upper(substr($this->__toString(), 1));
        $colors = Colors::toArray();
        $search = array_search($hex, $colors);

        if (is_string($search) && $search != false) {
            return ucwords(Str::of($search)->snake(' '));
        }

        return $hex;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "#{$this->red}{$this->green}{$this->blue}";
    }
}
