<?php

namespace Url\Infrastructure\TinyUrl;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Url\Domain\UrlProvider;

final class TinyUrlProvider implements UrlProvider
{
    private const HTTP_STATUS_OK = 200;

    public function __construct(
        private readonly Client $client,
        private readonly string $apiUrl
    ) {
    }

    public function generate(string $url): ?string
    {
        try {
            $response = $this->getResponse($url);
        } catch (GuzzleException) {
            return null;
        }

        if ($response->getStatusCode() === self::HTTP_STATUS_OK) {
            return (string) $response->getBody();
        }

        return null;
    }

    /**
     * @throws GuzzleException
     */
    private function getResponse(string $url): ResponseInterface
    {
        return $this->client->get(
            sprintf(
                $this->apiUrl,
                $url
            )
        );
    }
}
