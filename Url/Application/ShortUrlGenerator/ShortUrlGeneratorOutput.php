<?php

namespace Url\Application\ShortUrlGenerator;

final class ShortUrlGeneratorOutput implements \JsonSerializable
{
    public function __construct(
        private readonly ?string $url
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'url' => $this->url
        ];
    }
}
