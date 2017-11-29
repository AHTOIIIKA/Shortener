<?php

namespace Shortener\Service;

interface ServiceInterface
{
    public function shorten(string $url): string;
    public function expand(string $url): string;
}

