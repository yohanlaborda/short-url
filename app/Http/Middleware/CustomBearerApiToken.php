<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Url\Application\BearerStringValidator;

final class CustomBearerApiToken
{
    public function __construct(
        private readonly BearerStringValidator $bearerStringValidator
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearerToken = $request->bearerToken();
        if (empty($bearerToken)) {
            return $this->getErrorResponse('Bearer Token is empty');
        }

        if (false === $this->bearerStringValidator->validate($bearerToken)) {
            return $this->getErrorResponse('Bearer Token is not valid');
        }

        return $next($request);
    }

    private function getErrorResponse(string $error): Response
    {
        return new JsonResponse(['error' => $error]);
    }
}
