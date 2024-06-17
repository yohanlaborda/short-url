<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class HomeController
{
    public function __invoke(Request $request): Response
    {
        return new JsonResponse(['system' => 'Welcome']);
    }
}
