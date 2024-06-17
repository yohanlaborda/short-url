<?php

namespace Url\Domain\Sign;

abstract class Sign
{
    abstract public function start(): string;

    abstract public function end(): string;

    public function equal(self $sign): bool
    {
        return $sign->start() === $this->start()
            && $sign->end() === $this->end();
    }
}
