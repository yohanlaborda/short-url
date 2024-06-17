<?php

namespace Url\Domain;

interface UrlProvider
{
    public function generate(string $url): ?string;
}
