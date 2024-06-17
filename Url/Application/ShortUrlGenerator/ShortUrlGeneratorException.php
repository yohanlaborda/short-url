<?php

namespace Url\Application\ShortUrlGenerator;

use Throwable;

final class ShortUrlGeneratorException extends \Exception
{
    private function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    public static function cannotBeEmpty(): self
    {
        return new self('Url cannot be empty');
    }
}
