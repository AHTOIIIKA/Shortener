<?php

namespace Shortener\Algorithm;

interface AlgorithmInterface
{
    public function generate(string $url, int $length): string;
}
