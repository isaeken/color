<?php

namespace IsaEken\Color;

use IsaEken\Color\Color\Hex;
use IsaEken\Color\Color\Hsl;
use IsaEken\Color\Color\Hsla;
use IsaEken\Color\Color\Rgb;
use IsaEken\Color\Color\Rgba;

interface ColorInterface
{
    public static function fromString(string $string): static;

    public function red();

    public function green();

    public function blue();

    public function contrast();

    public function name(): string;

    public function toHex(): Hex;

    public function toHsl(): Hsl;

    public function toHsla(): Hsla;

    public function toRgb(): Rgb;

    public function toRgba(): Rgba;

    public function __toString(): string;
}
