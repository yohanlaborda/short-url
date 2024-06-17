<?php

namespace Url\Domain\Sign;

final class BracketSign extends Sign
{
    public function start(): string
    {
        return '(';
    }

    public function end(): string
    {
        return ')';
    }
}
