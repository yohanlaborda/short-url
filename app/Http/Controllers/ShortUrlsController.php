<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Url\Application\ShortUrlGenerator;
use Url\Application\ShortUrlGenerator\ShortUrlGeneratorInput;

final class ShortUrlsController
{
    public function __construct(
        private readonly ShortUrlGenerator $shortUrlGenerator
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $parameters = $this->getParameters($request);

        try {
            $output = $this->shortUrlGenerator->execute(
                new ShortUrlGeneratorInput(
                    (string) $parameters['url'] ?? ''
                )
            );
        } catch (\Throwable $throwable) {
            return new JsonResponse(['error' => $throwable->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($output);
    }

    private function getParameters(Request $request): array
    {
        try {
            return json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return [];
        }
    }
}
