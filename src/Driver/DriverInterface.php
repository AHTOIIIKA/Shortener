<?php

namespace Shortener\Driver;

interface DriverInterface
{
    public function shorten(string $url): string;
    public function expand(string $url): string;
}