<?php

namespace Url\Application;

use Url\Application\ShortUrlGenerator\ShortUrlGeneratorException;
use Url\Application\ShortUrlGenerator\ShortUrlGeneratorInput;
use Url\Application\ShortUrlGenerator\ShortUrlGeneratorOutput;
use Url\Domain\UrlProvider;

final class ShortUrlGenerator
{
    /**
     * @var UrlProvider[]
     */
    private array $providers = [];

    public function __construct(
        UrlProvider ...$providers
    ) {
        $this->providers = $providers;
    }

    /**
     * @throws ShortUrlGeneratorException
     */
    public function execute(ShortUrlGeneratorInput $input): ShortUrlGeneratorOutput
    {
        $url = $input->url();
        if (empty($url)) {
            throw ShortUrlGeneratorException::cannotBeEmpty();
        }

        return new ShortUrlGeneratorOutput(
            $this->getUrlFromProvider($url)
        );
    }

    private function getUrlFromProvider(string $url): ?string
    {
        foreach ($this->providers as $provider) {
            $urlFromProvider = $provider->generate($url);
            if (null !== $urlFromProvider) {
                return $urlFromProvider;
            }
        }

        return null;
    }
}
