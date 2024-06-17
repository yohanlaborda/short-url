<?php

namespace Url\Application\ShortUrlGenerator;

final class ShortUrlGeneratorInput
{
    public function __construct(
        private readonly string $url
    ) {
    }

    public function url(): string
    {
        return $this->url;
    }
}
