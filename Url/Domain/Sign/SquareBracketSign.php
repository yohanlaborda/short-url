<?php

namespace Url\Domain\Sign;

final class SquareBracketSign extends Sign
{
    public function start(): string
    {
        return '[';
    }

    public function end(): string
    {
        return ']';
    }
}
